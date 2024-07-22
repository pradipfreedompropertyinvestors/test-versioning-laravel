<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class UsersExport implements FromQuery, WithHeadings {
    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function query() {
        $query = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', '!=', auth()->user()->id)
            ->orderByDesc('users.created_at')
            ->select([
                'users.id', 'users.first_name', 'users.last_name', 'users.username', 'users.email',
                'users.mobile_number', 'users.gender', 'roles.name', 'users.status'
            ]);

        if ($this->request->has('status') && $this->request->status != '') {
            $query->where('users.status', $this->request->status);
        }

        if ($this->request->has('role_id') && $this->request->role_id != '') {
            $query->where('roles.id', $this->request->role_id);
        }

        return $query;
    }

    public function headings(): array {
        return [
            'ID', 'First Name', 'Last Name', 'Username', 'Email', 'Mobile Number', 
            'Gender', 'Role', 'Status'
        ];
    }
}
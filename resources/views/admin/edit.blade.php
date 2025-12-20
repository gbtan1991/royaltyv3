<x-layouts.app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Admin: {{ $admin->user->first_name }}</h2>

        <form action="{{ route('admin.update', $admin) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold border-b pb-2">Personal Identity</h3>
                    
                    <div>
                        <label class="block text-sm font-medium">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $admin->user->first_name) }}" class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Last Name *</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $admin->user->last_name) }}" class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Birth Date *</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $admin->user->birth_date) }}" class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Gender</label>
                        <select name="gender" class="w-full border rounded p-2">
                            @foreach(['Male', 'Female', 'Other'] as $option)
                                <option value="{{ $option }}" {{ old('gender', $admin->user->gender) == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-lg font-semibold border-b pb-2">Account Details</h3>

                    <div>
                        <label class="block text-sm font-medium">Employee ID *</label>
                        <input type="text" name="employee_id" value="{{ old('employee_id', $admin->employee_id) }}" class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Username *</label>
                        <input type="text" name="username" value="{{ old('username', $admin->username) }}" class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Role *</label>
                        <select name="role" class="w-full border rounded p-2">
                            <option value="Admin" {{ old('role', $admin->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Super Admin" {{ old('role', $admin->role) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" class="w-full border rounded p-2">
                            @foreach(['Active', 'Inactive', 'Locked'] as $status)
                                <option value="{{ $status }}" {{ old('status', $admin->status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded">
                <h3 class="text-sm font-bold text-yellow-800 mb-2">Change Password (Leave blank to keep current)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <input type="password" name="password" placeholder="New Password" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm New Password" class="w-full border rounded p-2">
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.index') }}" class="px-4 py-2 text-gray-600 bg-gray-200 rounded">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Update Admin</button>
            </div>
        </form>
    </div>
</x-layouts.app-layout>
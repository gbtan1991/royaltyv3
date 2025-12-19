<x-layouts.app-layout>

    <h1>Add new Admin</h1>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6">Add New Admin</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
            <p class="font-bold">Whoops! There were some problems with your input.</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="space-y-4">
                <h3 class="text-lg font-semibold border-b pb-2">Personal Identity</h3>
                
                <div>
                    <label class="block text-sm font-medium">First Name *</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full border rounded p-2 @error('first_name') border-red-500 @enderror">
                    @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Last Name *</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full border rounded p-2 @error('last_name') border-red-500 @enderror">
                    @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Birth Date *</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full border rounded p-2 @error('birth_date') border-red-500 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-medium">Gender</label>
                    <select name="gender" class="w-full border rounded p-2">
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-lg font-semibold border-b pb-2">Account Details</h3>

                <div>
                    <label class="block text-sm font-medium">Employee ID *</label>
                    <input type="text" name="employee_id" value="{{ old('employee_id') }}" class="w-full border rounded p-2 @error('employee_id') border-red-500 @enderror">
                    @error('employee_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Username *</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="w-full border rounded p-2 @error('username') border-red-500 @enderror">
                    @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Role *</label>
                    <select name="role" class="w-full border rounded p-2">
                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Status</label>
                    <select name="status" class="w-full border rounded p-2">
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="Locked" {{ old('status') == 'Locked' ? 'selected' : '' }}>Locked</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-4 rounded">
            <div>
                <label class="block text-sm font-medium text-blue-700">Password *</label>
                <input type="password" name="password" class="w-full border rounded p-2 border-blue-300">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-blue-700">Confirm Password *</label>
                <input type="password" name="password_confirmation" class="w-full border rounded p-2 border-blue-300">
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.index') }}" class="px-4 py-2 text-gray-600 bg-gray-200 rounded">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create Admin</button>
        </div>
    </form>
</div>
</x-layouts.app-layout>

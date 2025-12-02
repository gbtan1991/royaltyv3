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

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Username --}}
        <div class="mb-3">
            <label class="form-label">Username <span class="text-danger">*</span></label>
            <input 
                type="text" 
                name="username" 
                class="form-control" 
                value="{{ old('username') }}" 
                required
            >
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <input 
                type="password" 
                name="password" 
                class="form-control" 
                required
            >
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="locked" {{ old('status') == 'locked' ? 'selected' : '' }}>Locked</option>
            </select>
        </div>

        {{-- First Name --}}
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input 
                type="text" 
                name="first_name" 
                class="form-control" 
                value="{{ old('first_name') }}"
            >
        </div>

        {{-- Last Name --}}
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input 
                type="text" 
                name="last_name" 
                class="form-control" 
                value="{{ old('last_name') }}"
            >
        </div>

        {{-- Avatar Upload --}}
        <div class="mb-3">
            <label class="form-label">Avatar (optional)</label>
            <input 
                type="file" 
                name="avatar" 
                class="form-control"
                accept="image/*"
            >
        </div>

        <button type="submit" class="btn btn-primary">Create Admin</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Cancel</a>
    </form>


</x-layouts.app-layout>
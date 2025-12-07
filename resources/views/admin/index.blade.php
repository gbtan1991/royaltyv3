<x-layouts.app-layout>

 <h3>List of Admins</h3>


 <a href="{{ route('admin.create')  }}">Add new Admin</a>

<x-admin.admin-list :admins="$admins"/>
    

</x-layouts.app-layout>
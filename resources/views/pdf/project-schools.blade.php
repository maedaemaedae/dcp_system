<h2 style="text-align:center;">Schools under this Project</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead><tr><th>School ID</th><th>School Name</th></tr></thead>
    <tbody>
        @foreach ($schools as $school)
            <tr><td>{{ $school->school_id }}</td><td>{{ $school->school_name }}</td></tr>
        @endforeach
    </tbody>
</table>

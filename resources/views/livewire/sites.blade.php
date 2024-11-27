<table class="table table-sm table-hover">
    <thead>
        <th>#</th>
        <th>name</th>
        <th>description</th>
    </thead>
   <tbody>
        @foreach ($sites as $site)
        <tr>
            <td>{{$site->id}}</td>
            <td>{{$site->name}}</td>
            <td>{{$site->description}}</td>
        </tr>
        @endforeach
   </tbody>
</table>

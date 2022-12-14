@extends('layout.user')
@section('content')
<table class="table table-striped">
         <thead>
            <tr>
               <th scope="col">No.</th>
               <th scope="col">Name</th>
               <th scope="col">Article's Created</th>
               <th scope="col">Join Date</th>
               <th scope="col">Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach($data as $index => $item)
            <tr>
               <th>{{ $index + $data->firstItem() }}</th>
               <td>{{$item->name}}</td>
               <td>{{ $item->articles_count }} </td>
               <td>{{ $item->created_at }}</td>
               <td><a class="btn btn-primary rounded" href="memberDetail">Detail</a></td>
            </tr>
            @endforeach
         </tbody>
</table>
   <div class="paginationButtonLink" style="display: flex; justify-content: center;">
         {{ $data->links() }}
   </div>
@endsection
@extends('layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Menu Makanan Hari Ini</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('makanan.create') }}"> Create Menu Baru</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Makanan</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($menus as $menu)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $menu->nama_makanan}}</td>
        <td>{{ $menu->deskripsi}}</td>
        <td>{{ $menu->harga }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('makanan.show', $menu->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('makanan.edit',$menu->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['makanan.destroy', $menu->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>


    {!! $menus->links() !!}
@endsection
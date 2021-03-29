@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Daftar Tagihan</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Nama Lengkap</th>
                                    <th>No Telp</th>
                                    <th>Total Item</th>
                                    <th>Subtotal</th>
                                    <th>Pajak</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoice as $row)
                                    <tr>
                                        <td><strong>#{{ $row->id }}</strong></td>
                                        <td>{{ $row->customer->name }}</td>
                                        <td>{{ $row->customer->phone }}</td>
                                        <td><span class="badge badge-success">{{ $row->detail->count() }} Item</span></td>
                                        <td>Rp {{ number_format($row->total) }}</td>
                                        <td>Rp {{ number_format($row->tax) }}</td>
                                        <td>Rp {{ number_format($row->total_price) }}</td>
                                        <td>
                                            @if($row->status=="paid")
                                            <span class="badge badge-success">{{ $row->status}}</span>
                                            @elseif($row->status=="unpaid")
                                            <span class="badge badge-danger">{{ $row->status}}</span>
                                            @elseif($row->status=="panding")
                                            <span class="badge badge-warning">{{ $row->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(Auth::user()->akses=='pelanggan')
                                            <a href="{{ route('invoice.edit', $row->id) }}" class="btn btn-info btn-sm">Upload</a>
                                            @elseif(Auth::user()->akses=='admin')
                                            <form action="{{ route('invoice.destroy', $row->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('invoice.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $invoice->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <img src="{{ asset('kompas.jpg') }}" alt="" width="350px" height="150px">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="30%">Pelanggan</td>
                                        <td>:</td>
                                        <td>{{ $invoice->customer->name }}</td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $invoice->customer->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <td>{{ $invoice->customer->phone }}</td>
                                    </tr> -->
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $invoice->customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>{{ $invoice->status }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="30%">Perusahaan</td>
                                        <td>:</td>
                                        <td>Dampit Aagency</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>Joglo Jakarta Barat</td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <td>085343966997</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>dampitagency@gmail.com</td>
                                    </tr>
                                </table>
                            </div>
                            @if(Auth::user()->akses=='pelanggan')
                            <div class="col-md-12 mt-3">
                                <!-- <form action="{{ route('invoice.update', ['id' => $invoice->id]) }}" method="post">
                                @csrf -->
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Produk</td>
                                            <td>Qty</td>
                                            <td>Harga</td>
                                            <td>Subtotal</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($invoice->detail as $detail)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $detail->product->title }}</td>
                                            <td>{{ $detail->qty }}</td>
                                            <td>Rp {{ number_format($detail->price) }}</td>
                                            <td>Rp {{ $detail->subtotal }}</td>
                                            <!-- <td>
                                                <form action="{{ route('invoice.delete_product', ['id' => $detail->id]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE" class="form-control">
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                                    @elseif(Auth::user()->akses=='admin')
                                    <div class="col-md-12 mt-3">
                                        <form action="{{ route('invoice.update', ['id' => $invoice->id]) }}" method="post">
                                        @csrf
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Produk</td>
                                                        <td>Qty</td>
                                                        <td>Harga</td>
                                                        <td>Subtotal</td>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $no = 1 @endphp
                                                    @foreach ($invoice->detail as $detail)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $detail->product->title }}</td>
                                                        <td>{{ $detail->qty }}</td>
                                                        <td>Rp {{ number_format($detail->price) }}</td>
                                                        <td>Rp {{ $detail->subtotal }}</td>
                                                        <td>
                                                            <form action="{{ route('invoice.delete_product', ['id' => $detail->id]) }}" method="post">
                                                                 @csrf
                                                                <input type="hidden" name="_method" value="DELETE" class="form-control">
                                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <input type="hidden" name="_method" value="PUT" class="form-control">
                                                            <select name="product_id" class="form-control">
                                                                <option value="">Pilih Produk</option>
                                                                @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" min="1" value="1" name="qty" class="form-control" required>
                                                        </td>
                                                        <td colspan="3">
                                                            <button class="btn btn-primary btn-sm">Tambahkan</button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="col-md-4 offset-md-8">
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <td>Sub Total</td>
                                            <td>:</td>
                                            <td>Rp {{ number_format($invoice->total) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pajak</td>
                                            <td>:</td>
                                            <td>2% (Rp {{ number_format($invoice->tax) }})</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>:</td>
                                            <td>Rp {{ number_format($invoice->total_price) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            <div class="container">
                                <div class="card" style="width: 35rem;">
                                    <div class="card-header">
                                        <h5>Bukti Transfer</h5>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                @if($invoice->gambar=="")
                                                <img src="{{ asset('no-image.jpg') }}" class="img-fluid" alt="Responsive image">
                                                @else
                                                <img src="{{ asset('kompas.jpg') }}" class="img-fluid" alt="Responsive image">
                                                @endif

                                                @if(Auth::user()->akses=='pelanggan')
                                                <label for="inputGroupFile01">Upload Bukti Transfer</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="gambar" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="inputGroupFile01">Pilih Foto</label>
                                                    </div>
                                                </div>
                                                @elseif(Auth::user()->akses=='admin')
                                                <label for="status">STATUS</labe>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="paid" 
                                                    @if($invoice->status=="paid") selected @endif
                                                    >
                                                    Paid</option>
                                                    <option value="unpaid" 
                                                    @if($invoice->status=="unpaid") selected @endif
                                                    >
                                                    unpaid</option>
                                                    <option value="panding" 
                                                    @if($invoice->status=="panding") selected @endif
                                                    >
                                                    Pending</option>
                                                    <!-- <option value="unpaid">Unpaid</option>
                                                    <option value="panding">Panding</option> -->
                                                </select>
                                                @endif
                                                
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
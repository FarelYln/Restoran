@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pembayaran</h1>

    <form action="{{ route('pembayaran.store') }}" method="POST">
        @csrf                  
        <input type="hidden" value="{{$pesanan->id}}" name="pesanan_id" class="form-contro88l" readonly>
        
        <div class="form-group">
            <label for="pesanan_id">Meja: {{ $pesanan->meja->nomor_meja }}</label>
        </div>

        <div class="form-group mt-3">
            <label for="total_harga">Total Harga:</label>
            <input type="number" id="total_harga" name="total_harga" value="{{ number_format($pesanan->total, 0,'','') }}" class="form-control" readonly>
        </div>
<br>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="form-group mt-3">
            <label for="total_bayar">Total Bayar:</label>
            <input type="number" name="total_bayar" id="total_bayar" class="form-control" required>
        </div>
        

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<script>
document.getElementById('pesanan_id').addEventListener('change', function() {
    var pesananId = this.value;
    if (pesananId) {
        fetch(`/pesanan/${pesananId}/total`)
            .then(response => response.json())
            .then(data => {
                if (data.total) {
                    document.getElementById('total_harga').value = data.total.toFixed(2);
                } else {
                    document.getElementById('total_harga').value = '0.00';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('total_harga').value = '0.00';
            });
    } else {
        document.getElementById('total_harga').value = '';
    }
});
</script>
@endsection

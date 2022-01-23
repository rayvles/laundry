<div class="form-group">
    <label for="nama">Name Outlet</label>
    <input type="text" value="{{ $outlet->nama ?? old('nama') }}" name="nama" class="form-control" id="nama" placeholder="Outlet">
    @error('nama')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label for="telepon">Number Phone</label>
    <input type="tel" value="{{ $outlet->telepon ?? old('telepon') }}" name="telepon" class="form-control" id="telepon" placeholder="+62">
    @error('telepon')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label for="alamat">Address</label>
    <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Address Oulet">{{ $outlet->alamat ?? old('alamat') }}</textarea>
    @error('alamat')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

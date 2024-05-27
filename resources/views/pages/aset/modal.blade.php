@push('modal')
    <div class="modal animated fade fadeInDown" id="modal_form" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_form_title">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                    </button>
                </div>
                <form id="form" class="form-vertical" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="name">Name :</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Please Enter Name" minlength="3" maxlength="25" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="nilai">Nilai :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="number" name="nilai" class="form-control" id="nilai"
                                        placeholder="Please Enter Nilai" min="0" value="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="jenis">Jenis :</label>
                                <select name="jenis" id="jenis" class="form-control select2" style="width: 100%;">
                                    <option value="">--Pilih Jenis--</option>
                                    @foreach ($jenis as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="kategori">Kategori :</label>
                                <select name="kategori" id="kategori" class="form-control select2" style="width: 100%;">
                                    <option value="">--Pilih kategori--</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="lokasi">Lokasi :</label>
                                <select name="lokasi" id="lokasi" class="form-control select2" style="width: 100%;">
                                    <option value="">--Pilih lokasi--</option>
                                    @foreach ($locations as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="kondisi">Kondisi :</label>
                                <select name="kondisi" id="kondisi" class="form-control select2" style="width: 100%;">
                                    <option value="">--Pilih Kondisi--</option>
                                    <option value="baik">Baik</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="tgl_terima">Tgl Terima :</label>
                                <input type="text" name="tgl_terima" class="form-control datepicker" id="tgl_terima"
                                    placeholder="Please Enter Tgl Terima" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="batas">Batas Pemakaian :</label>
                                <div class="input-group">
                                    <input type="number" name="batas" class="form-control" id="batas"
                                        placeholder="Please Enter Batas Pemakaian" min="0" value="0"
                                        required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">Tahun</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="jumlah">Jumlah :</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah"
                                    placeholder="Please Enter Jumlah" min="1" value="0" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="status">Status :</label>
                                <select name="status" id="status" class="form-control select2" style="width: 100%;">
                                    <option value="">--Pilih Status--</option>
                                    <option value="terpakai">Terpakai</option>
                                    <option value="tidak terpakai">Tidak Terpakai</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="image">Image :</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image"
                                        onchange="readURL(this);" placeholder="Please Pick Image"
                                        accept="image/jpeg, image/png, image/jpg">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <small class="form-text text-muted">Max Size 2MB</small>
                                <img id="image_preview" src="#" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times mr-1" data-toggle="tooltip" title="Close"></i>Close</button>
                        <button type="button" id="modal_form_submit" class="btn btn-primary"><i
                                class="fas fa-paper-plane mr-1" data-toggle="tooltip" title="Save"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

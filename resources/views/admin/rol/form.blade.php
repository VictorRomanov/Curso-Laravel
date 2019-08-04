<div class="form-group">
    <label for="nombre" class="col-lg-3 control-label ">Nombre</label>
    <div class="col-lg-8">
      <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre', $data->nombre ?? '')}}" required>
    </div>
</div>

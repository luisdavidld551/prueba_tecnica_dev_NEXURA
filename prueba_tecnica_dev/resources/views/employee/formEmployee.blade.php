@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach( $errors->all() as $error)
            <li>{{ $error}}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="mb-3 row">
    <label for="nombre" class="col-sm-3">Nombre completo*</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }}" placeholder="Nombre completo del empleado">
    </div>
</div>

<div class="mb-3 row">
    <label for="email" class="col-sm-3">Correo electrónico*</label>
    <div class="col-sm-9">
        <input type="email" class="form-control" id="email" name="email" value="{{ isset($empleado->email)?$empleado->email:old('email') }}" placeholder="Correo electrónico">
    </div>
</div>

<div class="mb-3 row">
    <label for="sexo" class="col-sm-3">sexo*</label>
    <div class="col-sm-9">
        <div class="form-check">
                <input class="form-check-input" {{ (isset($empleado) && $empleado->sexo == "F") ? 'checked' : '' }} type="radio" name="sexo" id="sexo" value="F">
            Femenino
            </label>
        </div>
        <div class="form-check">
                <input class="form-check-input" {{ (isset($empleado) && $empleado->sexo == "M") ? 'checked' : '' }} type="radio" name="sexo" id="sexo" value="M">
            Masculino
            </label>
        </div>
    </div>
</div>

<div class="mb-3 row">
    <label for="area_id" class="col-sm-3">Área*</label>
    <div class="col-sm-9">
        <select class="form-select" aria-label="Default select example" name="area_id" id="area_id">
            @if(!isset($empleado))
                <option value="">Seleccione un area</option>
            @else
                <option value="{{$empleado->areas->id}}">{{$empleado->areas->nombre}}</option>
            @endif
            @foreach($areasAll as $area)
                @if(isset($empleado) && $area->id == $empleado->area_id)
                @else
                <option value="{{$area->id}}">{{$area->nombre}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3 row">
    <label for="descripcion" class="col-sm-3">Descripción*</label>
    <div class="col-sm-9">
        <textarea class="form-control" placeholder="Descripción de la experiencia del empleado" id="descripcion" name="descripcion" style="height: 100px">{{isset($empleado->descripcion)?$empleado->descripcion : ''}}</textarea>
        <div class="form-check mb-4 mt-2">
            <input class="form-check-input" {{ (isset($empleado) && $empleado->boletin == 1) ? 'checked' : '' }}  type="checkbox" value="1" id="boletin" name="boletin">
            <p class="form-check-label" for="boletin">
                Deseo recibir boletín informativo
            </p>
        </div>
    </div>
</div>

<div class="row">
    <label for="role_id" class="col-sm-3">Roles*</label>
    <div class="col-sm-9">
            <div class="form-check">
        @foreach($rolesAll as $role)
                @if(isset($empleado))
                    <input class="form-check-input" {{(in_array($role->id, $empleado->role)) ? 'checked' : '' }} type="checkbox" value="{{$role->id}}" id="role_id" name="role_id[]">
                    <p class="form-check-label" for="role_id">{{ $role->nombre }}</p>
                @else
                    <input class="form-check-input" type="checkbox" value="{{$role->id}}" id="role_id" name="role_id[]">
                    <p class="form-check-label" for="role_id">
                    {{ $role->nombre }}
                </p>
                @endif
        @endforeach
            </div>
    </div>
</div>

<div class="row">
    <span  class="col-sm-3"></span>
    <div class="col-sm-9">
        <button type="submit" onclick="return confirm('¿Deseas {{$mode}} este registro?')" class="btn btn-primary">{{$mode}}</button>
    </div>
</div>
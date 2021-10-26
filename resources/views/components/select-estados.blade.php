<?php
$estados = [];
$estados[] = "Acre";
$estados[] = "Alagoas";
$estados[] = "Amapá";
$estados[] = "Amazonas";
$estados[] = "Bahia";
$estados[] = "Ceará";
$estados[] = "Distrito Federal";
$estados[] = "Espirito Santo";
$estados[] = "Goiás";
$estados[] = "Maranhão";
$estados[] = "Mato Grosso do Sul";
$estados[] = "Mato Grosso";
$estados[] = "Minas Gerais";
$estados[] = "Pará";
$estados[] = "Paraíba";
$estados[] = "Paraná";
$estados[] = "Pernambuco";
$estados[] = "Piauí";
$estados[] = "Rio de Janeiro";
$estados[] = "Rio Grande do Norte";
$estados[] = "Rio Grande do Sul";
$estados[] = "Rondônia";
$estados[] = "Roraima";
$estados[] = "Santa Catarina";
$estados[] = "São Paulo";
$estados[] = "Sergipe";
$estados[] = "Tocantins";
?>

<select class="custom-select" id="estado" name="estado" {{ $attributes }}>
    <option selected disabled value="">Escolha...</option>
    @foreach ($estados as $estado)
      @if ($select == $estado)
        <option value="{{ $estado }}" selected>{{ $estado }}</option>
      @else
        <option value="{{ $estado }}">{{ $estado }}</option>
      @endif
    @endforeach
</select>

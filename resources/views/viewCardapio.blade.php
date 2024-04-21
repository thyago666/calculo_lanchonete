<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@php
    $lastDescProd = null;
    $total_ingredientes = 0;
    $desc = null;
    $total_acessorio = 0;
  
@endphp


@for($i=1; $i <= $countProdutos*2; $i++)
@foreach($resultado as $item)


@if($item->idProd == $i)


            @if($lastDescProd !== $item->desc_prod)
            <hr>
                <p><b>{{ $item->desc_prod }}</b></p>
                @php
                    $lastDescProd = $item->desc_prod;
                @endphp
            @endif

              {{ $item->descricaoSimples }},

            @if($item->unidMedida == 'kilo')
                @php
                    $resul = ($item->valor*$item->qtd)/1000;
                    $total_ingredientes = $total_ingredientes + $resul;
                @endphp
            @endif

            @if($item->unidMedida == 'litro')
                @php
                    $resul = ($item->valor*$item->qtd)/900;
                    $total_ingredientes = $total_ingredientes + $resul;
                @endphp
            @endif

            @if($item->unidMedida == 'porcao')
                @php
                    $valor_cada_porcao = ($item->valor/$item->qtd_porcao);
                    $resul = ($valor_cada_porcao*$item->qtd);
                    $total_ingredientes = $total_ingredientes + $resul;
                @endphp
            @endif

            @if($item->unidMedida == 'unidade')
                @php
                    $resul = ($item->valor*$item->qtd);
                    $total_ingredientes = $total_ingredientes + $resul;
                @endphp
            @endif
   
@endif
    @endforeach
        @foreach ($acessorios as $acessorio)
                @if($acessorio->idProd == $i)
            @php
                $total_acessorio = ($total_acessorio+$acessorio->valor*$acessorio->qtd_itens);
            @endphp
            @endif
        @endforeach
  
    @if($total_ingredientes != 0 or $total_acessorio != 0)
    <br><br>
    <b>  Valor Loja: {{  'R$ '.number_format(($total_ingredientes+$total_acessorio)*$markup, 2, ',', '.') }}</b></br>
    <b>  Valor Ifood: {{  'R$ '.number_format(($total_ingredientes+$total_acessorio)*$markupIfood, 2, ',', '.') }}</b></br>
    <b>  Valor Iqfome: {{  'R$ '.number_format(($total_ingredientes+$total_acessorio)*$markupIqfome, 2, ',', '.') }}</b>
    @php
    $total_ingredientes = 0;
    $total_acessorio = 0;
    @endphp
    @endif
    
@endfor
</body>
</html>

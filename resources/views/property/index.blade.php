@extends('property.master')


@section('content')

<div class="container my-3">
    <h1>Imoveis Disponiveis</h1>


    <?php 

    if(!empty($properties)){
        
        echo "<table class=' table table-striped table-hover'>";

        echo "<thead class='bg-primary text-white'>
                    <td>Título</td>
                    <td>Valor de Locação</td>
                    <td>Valor de Compra</td>
                    <td>Ações</td>
            </thead>";

        foreach($properties as $property){

            $linkReadMode = url('/imoveis' . $property->name);
            $linkEditMode = url('/imoveis/editar/' . $property->name);
            $linkRemoveitem = url('/imoveis/remover/' . $property->name);

            echo "<tr>
                        <td>{$property->title}</td>
                        <td>R$ ". number_format($property->rental_price, 2, ',', '.') . "</td>
                        <td>R$ ". number_format($property->sale_price, 2, ',', '.') . "</td>
                        <td><a href='{$linkReadMode}'>Ver Detalhes</a> | <a href='{$linkEditMode}'>Editar</a> | <a href='{$linkRemoveitem}'>Remover</a></td>
                </tr>";
            }

            echo "</table>";

    } else {
        echo "Não tem nenhum imovel cadastrado.";
    };

    ?>
</div>
@endsection()
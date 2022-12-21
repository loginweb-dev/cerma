function formatResultAfiliados(option){
    // Si está cargando mostrar texto de carga
    if (option.loading) {
        return '<span class="text-center"><i class="fas fa-spinner fa-spin"></i> Buscando...</span>';
    }
    // Mostrar las opciones encontradas
    let image = option.foto ? `../../storage/${option.foto.replace('.', '-cropped.')}` : `../../storage/users/default.png`;
    return $(`<span>
                    <div class="row">
                        <div class="col-sm-12" style="margin:0px">
                            <table>
                                <tr>
                                    <td>
                                        <img src="${image}" width="80px" style="margin-right:10px" />
                                    </td>
                                    <td>
                                        <b class="text-dark" style="font-size: 18px">${option.nombre_completo}</b><br>
                                        ${option.rau ? 'RAU: '+option.rau : 'CI: '+option.ci}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </span>`);
}
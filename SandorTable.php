<?php

namespace App\Http\Controllers\Sandor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SandorTable extends Controller
{
    /**
     * @param $status
     * @return mixed
     */
    public function colorStatus($status){

        $color = [
            'alert alert-primary',
            'alert alert-secondary',
            'alert alert-success',
            'alert alert-danger',
            'alert alert-warning',
            'alert alert-info',
            'alert alert-light',
            'alert alert-dark',
            'alert alert-primary',
            'alert alert-secondary',
            'alert alert-primary',
            'alert alert-secondary',
            ];

        switch ($status){
            case 1:
                $colorStatus = $color[2];
                break;
            case 2:
                $colorStatus = $color[4];
                break;
            case 3:
                $colorStatus = $color[3];
                break;
        }

        return $colorStatus;
    }


    /**
     * @param $id
     * @param $value
     * @param $onclickScript
     * @param $class
     * @return string
     */
    public function pageCode($id, $value, $onclickScript, $class ){
        return '<li class="page-item '.$class.'" style="min-width: 60px; max-width: 60px; text-align: center;">
                              <a class="page-link" href="#" id="page-'.$id.'" '.$onclickScript.'>'.$value.'</a>
                            </li>';
    }


    /**
     * @param $numberOfEntries
     * @param Request $request
     * @return string
     */
    public function paginationCode($numberOfEntries, Request $request){
        //Paginazione
        $numeroOfPages = ceil($numberOfEntries/$request->nRows);

        $onclickScript = 'onclick="json_table(\'CHANGE-PAGE\', event);"';

        $previousDisable = ($request->nPage == 1) ? 'disabled' : '';
        $nextDisable = ($request->nPage == $numeroOfPages) ? 'disabled' : '';

        $pagination =   '<table><tr><td colspan="3" class="pageQuantity"><input type="hidden" value="'.$request->nPage.'" id="nPage"> Page '.$request->nPage.' of '.$numeroOfPages.'</td></tr><tr><td colspan="5">
                        <nav aria-label="...">
                          <ul class="pagination">
                          <li class="page-item '.$previousDisable.'" >
                              <a class="page-link" href="#" id="page-'.($request->nPage -1 ).'" '.$onclickScript.'>Previous</a>
                            </li>';


        $puntini = $this->pageCode('', '...', '', 'disabled' );

        for($i=1; $i <= $numeroOfPages; $i++){

            $codiceNumeroPagina = $this->pageCode($i, $i, $onclickScript, '' );

            //pagina selezionata
            if($i == $request->nPage){
                $pagination .= $this->pageCode($i, $i, $onclickScript, 'disabled' );
            }

            $leftButton = $request->nPage - $i;
            $rightButton = $i - $request->nPage;

            if($numeroOfPages > 16){

                if($request->nPage != $i){
                    switch ($i) {
                        case 1:
                            $pagination .= $codiceNumeroPagina;
                            break;
                        case 2:
                            $pagination .= $codiceNumeroPagina;
                            break;
                        case 3:
                            $pagination .= $codiceNumeroPagina;
                            break;
                        default:
                            //Mostro i pulsanti a sinistra
                            if(($i < $request->nPage) && ($leftButton < 3) && ($i < ($numeroOfPages -2))){
                                $pagination .= $codiceNumeroPagina;
                            } else{
                                if(($leftButton == 3) && ($i > 3)){
                                    $pagination .= $puntini;
                                }
                            }
                    }
                }


                switch ($request->nPage) {
                    case 1:
                        if($i == 4){
                            $pagination .= $puntini.$this->pageCode((ceil($numeroOfPages/2))-2, ceil($numeroOfPages/2)-2, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))-1, ceil($numeroOfPages/2)-1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+1, ceil($numeroOfPages/2)+1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+2, ceil($numeroOfPages/2)+2, $onclickScript, '' );
                        }
                        break;
                    case 2:
                        if($i == 5){
                            $pagination .= $puntini.$this->pageCode((ceil($numeroOfPages/2))-1, ceil($numeroOfPages/2)-1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+1, ceil($numeroOfPages/2)+1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))-2, ceil($numeroOfPages/2)-2, $onclickScript, '' );
                        }
                        break;
                    case 3:
                        if($i == 6){
                            $pagination .= $puntini.$this->pageCode((ceil($numeroOfPages/2))-1, ceil($numeroOfPages/2)-1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+1, ceil($numeroOfPages/2)+1, $onclickScript, '' );
                        }
                        break;
                    case 4:
                        if($i == 7){
                            $pagination .= $puntini.$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+1, ceil($numeroOfPages/2)+1, $onclickScript, '' );
                        }
                        break;
                    case 5:
                        if($i == 8){
                            $pagination .= $puntini.$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' );
                        }
                        break;
                    case 6:
                        if($i == 9){
                            $pagination .= $puntini;
                        }
                        break;

                    case ($numeroOfPages - 5 ):
                        if($i == ($numeroOfPages - 8)){
                            $pagination .= $puntini;
                        }
                        break;
                    case ($numeroOfPages - 4 ):
                        if($i == ($numeroOfPages - 7)){
                            $pagination .= $this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$puntini;
                        }
                        break;
                    case ($numeroOfPages -3 ):
                        if($i == ($numeroOfPages - 6)){
                            $pagination .= $this->pageCode((ceil($numeroOfPages/2))-1, ceil($numeroOfPages/2)-1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$puntini;
                        }
                        break;
                    case ($numeroOfPages -2 ):
                        if($i == ($numeroOfPages - 5)){
                            $pagination .= $this->pageCode((ceil($numeroOfPages/2))-1, ceil($numeroOfPages/2)-1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+1, ceil($numeroOfPages/2)+1, $onclickScript, '' ).$puntini;
                        }
                        break;
                    case ($numeroOfPages -1 ):
                        if($i == ($numeroOfPages - 4)){
                            $pagination .= $this->pageCode((ceil($numeroOfPages/2))-1, ceil($numeroOfPages/2)-1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+1, ceil($numeroOfPages/2)+1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+2, ceil($numeroOfPages/2)+2, $onclickScript, '' ).$puntini;
                        }
                        break;
                    case $numeroOfPages:
                        if($i == ($numeroOfPages - 3)){
                            $pagination .= $this->pageCode((ceil($numeroOfPages/2))-2, ceil($numeroOfPages/2)-2, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))-1, ceil($numeroOfPages/2)-1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2)), ceil($numeroOfPages/2), $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+1, ceil($numeroOfPages/2)+1, $onclickScript, '' ).$this->pageCode((ceil($numeroOfPages/2))+2, ceil($numeroOfPages/2)+2, $onclickScript, '' ).$puntini;
                        }
                        break;
                    default:
                }
                if($request->nPage != $i){
                    switch ($i) {
                        case $numeroOfPages:

                            $pagination .= $codiceNumeroPagina;

                            break;
                        case ($numeroOfPages - 1):

                            $pagination .= $codiceNumeroPagina;

                            break;
                        case ($numeroOfPages - 2):

                            $pagination .= $codiceNumeroPagina;

                            break;
                        default:
                            //Mostro il pulsante a destra
                            if(($i > $request->nPage) && ($rightButton < 3) && ($i > 3)){
                                $pagination .= $codiceNumeroPagina;
                            } else{
                                if(($rightButton == 3) && ($i < ($numeroOfPages - 2))){
                                    $pagination .= $puntini;
                                }
                            }
                    }
                }
            } else {
                if($request->nPage != $i){
                    $pagination .= $this->pageCode($i, $i, $onclickScript, '' );
                }
            }
        }
        $pagination .= '  <li class="page-item '.$nextDisable.'">
                              <a class="page-link" href="#" id="page-'.($request->nPage +1 ).'" '.$onclickScript.'>Next</a>
                            </li>
                          </ul>
                        </nav></td> </tr></table>';

        return $pagination;
    }

}

/**
 * Created by
 'use strict';
  
 /**
  *
  * @param $scope
  * @param $log
  * @param $state
  * @param $timeout
  * @param $dialog
  */
function AbstractCRUDController($scope, $state, $stateParams, $rootScope, $timeout) {

    /*-------------------------------------------------------------------
     *                          ATTRIBUTES
     *-------------------------------------------------------------------*/

    /*-------------------------------------------------------------------
     *                          EVENT HANDLERS
     *-------------------------------------------------------------------*/
    /**
      * Handler que escuta as mudanças de URLs pertecentes ao estado da tela.
      * Ex.: listar, criar, detalhe, editar
      *
      * Toda vez que ocorre uma mudança de URL se via botão, troca de URL manual, ou ainda
      * ao vançar e voltar do browser, este evento é chamado e chama o initilize() que faz o papel de front-controller.
      *
      */
    $scope.$on('$stateChangeSuccess', function (event, toState, toParams, fromState, fromParams) {
        $scope.initialize(toState, toParams, fromState, fromParams);
    });

    /*
     * Valida os campos do formulário
     * */
    $scope.validateForm = function () {
        if(!$scope.model.form.$valid) {
            //$scope.showMessage($scope.INVALID_FORM_MESSAGE);
            return false;
        }
        return true;
    };
}
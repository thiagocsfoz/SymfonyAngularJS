(function (window, angular, undefined) {
    'use strict';

    //Start the AngularJS
    var myapp = angular.module('Admin', ['ui.router']);

    myapp.config(function ($stateProvider, $urlRouterProvider) {

        //-------
        //URL Router
        //-------

        //HOME
        $urlRouterProvider.otherwise("/");

        $stateProvider
        .state('admin', {
            url: '/',
            template: '<div ui-view/>',
            controller: 'AdminController as adminController'
        })
        .state('admin.index', {
            url: '',
            templateUrl: '../bundles/admin/templates/index.html'
        });

        /**
         *
         */
        myapp.run( function( $rootScope, $window, $state, $stateParams) {
            $rootScope.$state = $state;
            $rootScope.$stateParams = $stateParams;
        });
    });
}) (window, window.angular);


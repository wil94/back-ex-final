<?php 
	class TestingBasic {

		public static function firstTest() {
			
		}

        public static function jsonTest() {
            // Con esto se recibe un json como rest y se lo cambia a formato para php
            $JsonDecodeado = json_decode(file_get_contents('php://input'), true);
            print_r($JsonDecodeado);

            // mostrando lo que llego
            echo json_encode($JsonDecodeado);

            // si no llega nada retorna null, para validar
            
        }


        public static function jsonTestAndroid () {
            $objectReturn = new stdClass();
            $objectReturn->id = "u1";
            $objectReturn->nombre = "Wil";
            //$objectReturn->results = [];
            echo json_encode($objectReturn);
            // permitir peticiones externas
            header('Access-Control-Allow-Origin: *');
            // retornando en json en cuanto el front lo llame
            // header('Content-Type: application/json');


        }

        public static function receiveDataApp () {
            //$a = $_POST['idPrueba'];

            // $JsonDecodeado = json_decode(file_get_contents('php://input'), true);
            // print_r($JsonDecodeado);

            // // mostrando lo que llego
            // echo json_encode($JsonDecodeado);


            $objectReturn = new stdClass();
            $objectReturn->correcto = true;
            $objectReturn->mensaje = "HHHH";
            //$objectReturn->mensaje = "Respuesta correcta";
            //$objectReturn->listaResultado = [];

            echo json_encode($objectReturn);
        }
	}
 ?>
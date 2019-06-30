<?php

require_once 'FormField.php';

class FileFormField extends FormField
{
   protected $extensionesPermitidas;

   public function __construct(string $nombre, bool $obligatorio, array $extensionesPermitidas = [], string $mensaje = null) {
      parent::__construct($nombre, $obligatorio, $mensaje);
      $this->extensionesPermitidas = $extensionesPermitidas;
   }

   public function getExtensionesPermitidas() : array {
      return $this->extensionesPermitidas;
   }

   public function validar(string $valor) : ?string {
      if ($this->esObligatorio() && $valor == '') {
         return 'Debe completar este campo';
      } elseif ($valor != '') {
         $file = $this->formValidator->getArray($this->nombre);
         switch ($file['error']) {

            case UPLOAD_ERR_OK:

            $archivo = $valor;
            $ext = pathinfo($archivo, PATHINFO_EXTENSION);
            if ($this->extensionesPermitidas) {
               for ($i = 1; $i < count($this->extensionesPermitidas); $i++) {
                  if ($ext == $this->extensionesPermitidas[$i])
                     break;
               }
               if ($i == count($this->extensionesPermitidas)) {
                  return $this->mensaje ? $this->mensaje : 'El archivo debe ser de tipo ' . $this->listaDeExtensiones();
               }
            }
            break;

            case UPLOAD_ERR_INI_SIZE:

            return 'El archivo no debe tener más de ' . upload_max_filesize . ' bytes';
            break;

            case UPLOAD_ERR_FORM_SIZE:

            return 'El archivo no debe tener más de ' . MAX_FILE_SIZE . ' bytes';
            break;

            default:

            return 'No se pudo cargar el archivo';
            break;
         }
      }

      return null;
   }

   private function listaDeExtensiones() : string {
      $cant = count($this->extensionesPermitidas);
      $lista = '';

      for ($i = 0; $i < $cant; $i++) {
         if ($i > 0) {
            if ($i == $cant - 1) {
               $lista .= ' o ';
            }
            else {
               $lista .= ', ';
            }
         }
         $lista .= $this->extensionesPermitidas[$i];
      }

      return $lista;
   }
}

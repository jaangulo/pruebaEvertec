 <!-- Contenido Principal -->
 <!-- se extiende de la plantilla principal -->
 @extends('principal')
 <!-- se crea una seccion con el nombre de contenido para ser llamado en el principal html -->
 @section('contenido')
 

 <template v-if="menu==1">
   <!-- // componente  que se encuentra en la carpeta components de vue -->
   <pago>Contenido del menu1</pago>
 </template>
 <template v-if="menu==2">
   <!-- // componente  que se encuentra en la carpeta components de vue -->
   <persona>Contenido del menu2</persona>
 </template>


 @endsection
 <!-- /Fin del contenido principal -->

<div class="alert alert-danger" style="text-align:left; margin-top: 15px;" ng-if="errors.length>0">
   <b> <p>Corrige los siguientes errores:</p> </b>
   <ul ng-repeat="mensaje in errors">
      <li>@{{mensaje[0] }}</li>
   </ul>
</div>

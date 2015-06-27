<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Recordar Contraseña</title>
      <style>
          @import url([[ asset('app_cliente/img_email/fonts.css')]]);
         /* All your usual CSS here */
         @media (min-width: 480px) {
               .header{
                     background:url([[ asset('app_cliente/img_email/header-left.png')]])
                     left center no-repeat,url([[ asset('app_cliente/img_email/header-right.png')]]) right top no-repeat, #69A15B;
               }
               .footer {
                     background:url([[ asset('app_cliente/img_email/header-left.png')]]) left center no-repeat,url([[ asset('header-right.png')]])right top no-repeat, #69A15B;
               }
               
         }
         @media (max-width: 480px) {
               .logo{
                    height: 100px;
                    width: auto;
               }
               
         }
      </style>
   </head>
   <body style="width:100%;max-width:100%; margin:0;background-color:#FFF;">
      <div style="margin:0 auto;background-color:#eeeeee;width: 100%;max-width: 930px;">
         <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
            <tbody>
               <tr>
                  <td align="center" valign="top">
                     <table width="100%" class="header" height="177px" border="0" cellspacing="0" cellpadding="0" bgcolor="#69A15B" >
                        <tbody>
                           <tr>
                              <td align="center" valign="middle">
                                 <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                    <tbody>
                                       <tr>
                                          <td width="50%" align="left" valign="middle" style="padding-bottom:10px;padding-top:10px;padding-left:40px;">
                                             <div align="center"><a href="" target="_blank"><img src="[[ asset('app_cliente/img_email/mercafresco.png')]]" width="auto" height="150px" border="0" alt="" style="display:block;" class="logo"></a></div>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                        <tbody>
                           <tr>
                              <td align="center" valign="top" style="padding-top:40px;padding-left:20px;padding-right:20px">
                                 <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
                                    <tbody>
                                       <tr>
                                          <td align="center" style="padding-top:40px;padding-left:40px;padding-right:40px;font-size:40px;line-height:40px">
                                             <font face="'bebasregular'" color="#90A04A" style="font-size:50px;line-height:40px">
                                              BIENVENIDO A MERCAFRESCO</font>
                                          </td>
                                       </tr>
                                       
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <table width="100%" border="0" cellspacing="0" cellpadding="0"  >
                        <tbody>
                           <tr>
                              <td align="center" valign="top" style="padding-left:20px;padding-right:20px">
                                 <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
                                    <tbody>
                                       <tr>
                                          <td align="center" style="padding-top:20px;padding-bottom:20px;padding-left:40px;padding-right:40px">
                                             <font face="Helvetica, sans-serif" color="#333333" style="font-family: Arial, Helvetica, sans-serif;font-size:18px;line-height:20px">
                                             Encantados de conocerte [[$nombres]].
                                             <br><br>
                                             Le informamos que su registro en la plataforma se ha realizado exitosamente, sus datos de ingreso son los siguientes: 
                                             <br><br>
                                             Usuario: [[$usuario]]
                                             <br>
                                             Contraseña: [[$clave]]
                                             <br>
                                             Para activar su cuenta de clic <a href="[[$key]]" target="_blank">aquí</a>.
                                             </font>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                    
                     <!-- seccion de destacados -->
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                        <tbody>
                           <tr>
                              <td align="center" valign="top" style="padding-bottom:0px">
                                 <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#90A04A">
                                    <tbody>
                                       <tr>
                                          <td  align="center" style="padding-top:20px;padding-bottom:20px;padding-left:0px;padding-right:0px">
                                             
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <!-- fin de destacada-->
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#69A15B"  class="footer">
                        <tbody>
                           <tr>
                              <td align="center" valign="top">
                                 <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                    <tbody>
                                       <tr>
                                          <td align="center" style="padding-top:5px;padding-bottom:40px;padding-left:20px;padding-right:20px">
                                             <table border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                   <tr>
                                                     <td valign="middle" align="center">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                  <tbody>
                                                                        <tr>
                                                                                <td valign="middle" align="right" style="padding-top:30px;padding-bottom:3px;padding-left:0;padding-right:40px;height:50px;line-height:1.4">
                                                                               <font face="Helvetica, sans-serif" color="#FFFFFF" style="font-size:16px;line-height:18px">
                                                                                Síguenos:          
                                                                              </font>
                                                                         </td>  
                                                                         <td valign="middle" align="left" style="padding-top:30px;padding-bottom:3px;padding-left:0;padding-right:40px;height:50px;line-height:1.4">
                                                                              
                                                                              <a style="padding:0;margin:0 auto!important; text-decoration:none;" href="" target="_blank">
                                                                              <img width="27" border="0" style="width:27px;min-height:24px" alt="facebook" src="[[asset('app_cliente/img_email/icon-facebook.png')]]" class="CToWUd">
                                                                              </a>
                                                                              <a style="padding:0;margin:0 auto!important;text-decoration:none;" href="" target="_blank">
                                                                              <img width="27" border="0" style="width:27px;min-height:24px" alt="twitter" src="[[ asset('app_cliente/img_email/icon-instagram.png')]]" class="CToWUd">
                                                                              </a>
                                                                              <a style="padding:0;margin:0 auto!important;text-decoration:none;" href="" target="_blank">
                                                                              <img width="27" border="0" style="width:27px;min-height:24px" alt="googlemas" src="[[ asset('app_cliente/img_email/icon-mail.png')]]" class="CToWUd">
                                                                              </a>
                                                                        </td>
                                                                        </tr>
                                                                  </tbody>
                                                             </table>
                                                     </td>    
                                                   </tr>
                                                   <tr>
                                                      <td align="center" valign="middle" style="padding-left:0px;padding-right:0px;padding-top:5px;padding-bottom:0px">
                                                         <font face="Helvetica, sans-serif" color="#FFFFFF" style="font-size:18px;line-height:18px">
                                                             Escríbenos a contacto@mercafresco.co         
                                                         </font>
                                                      </td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </body>
</html>
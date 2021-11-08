
<!-- Start content  -->

<div class="content">
    <article class="col-1">
        <div class="col_title">S�curit�</div>
        <div class="col_text">
            <p class="pm">
                De ce fait nous vous invitent a ignorer les avertissements par email qui invitent � payer avec Erecovery qui n��mane pas de nos partenaires certifier, Si des sites Internet, des mails ou autres activit�s en ligne vous paraissent suspects, veuillez les communiquer � l��quipe de s�curit� Erecovery � l�adresse email suivante : info@Erecovery.net.        
            </p>                
            <p class="pm" align="center">
                <a href="securite-Edinars.html" class="link">Plus information</a>
            </p>
        </div>
    </article>
    <article class="col-2">
        <div class="col_title">Les tarifs avec Erecovery</div>
        <div class="col_text">
                    <p class="pm" align="centre">
                                    <table id="hor-minimalist-a" summary="Informations Generales">
                                        <thead>
                                            <tr>
                                                <th scope="col">Inscription :</th>
                                                <th scope="col">GRATUITE</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Service Particuliers:</th>
                                                <th scope="col">GRATUITE</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Service Professionnels:</th>
                                                <th scope="col"><?php echo prnsumm($data['PaymentPercent'])?>% &nbsp;+&nbsp; <?php echo prnsumm($data['PaymentFees'])?>&nbsp;<?php echo prntext($data['Currency'])?></th>
                                        
                                            </tr>
                                            <tr>
                                                <th scope="col">Cr�diter de l'argent � partir de compte ccp :</th>
                                                <th scope="col"><?php echo prnsumm($data['DepositMethod']['CCP']['prcn'])?>% &nbsp;+&nbsp; <?php echo prnsumm($data['DepositMethod']['CCP']['fees'])?>&nbsp;<?php echo prntext($data['Currency'])?></th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Cr�diter de l'argent � partir de votre carte de recharge :</th>
                                                <th scope="col"><?php echo prnsumm($data['DepositMethod']['topup']['prcn'])?>% &nbsp;+&nbsp; <?php echo prnsumm($data['DepositMethod']['topup']['fees'])?>&nbsp;<?php echo prntext($data['Currency'])?></th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Retirer de l'argent par ch�que banquer :</th>
                                                <th scope="col"> <?php echo prnsumm($data['WithdrawMethod']['cheque']['fees'])?>&nbsp;<?php echo prntext($data['Currency'])?></th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Retirer de l'argent par virement CCP :</th>
                                                <th scope="col"><?php echo prnsumm($data['WithdrawMethod']['ccp']['fees'])?>&nbsp;<?php echo prntext($data['Currency'])?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </p>    
        </div>
    </article>
    <div class="clr"></div>

</div>

<!-- End content  -->
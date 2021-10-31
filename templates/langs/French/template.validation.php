<!-- Start content  -->

<div class="content">
<?if(isset($data['ScriptLoaded'])){?>
<article class="col-3">
                            <div class="col_title"><?php echo $_SESSION['post_header']?></div>
                            <div class="col_text">
                                <p class="pm">    
                                    <?if($data['Error']){?>
                                        <?php echo prntext($_SESSION['Error'])?>.</p>
                                    <? } elseif (isset($_GET['c'])) { ?>
                                        <?php echo $_SESSION['post_detail']?>
                                    <?} else { ?>
                                        <?php echo $_SESSION['post_detail']?>
                                    <? } ?>
                                </p>

                            </div>
</article>


<?}else{?>SECURITY ALERT: Access Denied<?}?>
 <div class="clr"></div>

</div>

<!-- End content  -->


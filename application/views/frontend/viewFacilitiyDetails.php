<section class="section p_bot0  rooms rooms-widget grey_bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1><?= $facilities['sports_facilities_name']?></h1>
            </div>
            <!-- <div class="col-sm-12 col-md-8 col-md-offset-2">
                <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title="" class="img-responsive">
            </div> -->
            <div class="col-sm-12">
                <div class="owl-carousel owl-theme owl_acitivity">
                    <?php if(isset($facilitY_images) && $facilitY_images): foreach($facilitY_images as $key=>$image):?> 
                        <div class="item wow <?php ($key%2)?'bounceInUp':'bounceInDown'?>">
                            <article>
                                <div class="image"> <img src="<?= base_url()?>public/admin_images/sports_facilities/<?= $image['sports_facilities_image_file']?>" alt="" title=""> </div>
                                <div class="details">
                                    <div class="text text-center">
                                        <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; endif?>
                    <!-- <div class="item wow bounceInUp">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item wow bounceInDown">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item wow bounceInUp">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article>
                            <div class="image"> <img src="https://lh5.googleusercontent.com/p/AF1QipO6fzKeRhPiJiqcavd4jRXLk2QEYTjhMraVM23c=w1080-k-no" alt="" title=""> </div>
                            <div class="details">
                                <div class="text text-center">
                                    <h3 class="title"><a href="javascript:void(0);">Stadium View</a></h3>
                                </div>
                            </div>
                        </article>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="p_top30 p_bot30 ">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-8 col-md-offset-2 text-left">
                <table class="m_top20 table table-bordered">
                    <tr>
                        <th>Location :</th>
                        <td><?= $facilities['location_name']?></td>
                    </tr>
                    <tr>
                        <th>Address :</th>
                        <td><?= $facilities['address']?></td>
                    </tr>
                    <tr>
                        <th>Contact No. :</th>
                        <td><?= $facilities['contact_no']?></td>
                    </tr>
                    <tr>
                        <th>e-mail ID :</th>
                        <td><?= $facilities['email']?></td>
                    </tr>
                    <tr>
                        <th>Available Timings (during a day) :</th>
                        <td>6 AM - 8 PM(Everyday)</td>
                    </tr>
                    <tr>
                        <th>Available Sports Infrastructure :</th>
                        <td>
                            <?php if(count($facilities['amenitis']) > 0):?>
                                <?php foreach($facilities['amenitis'] as $amenity):?>
                                    <?= $amenity['facilities_amenitis_name']?>,
                                <?php endforeach?>
                            <?php endif?>
                        </td>
                    </tr>
                    <tr>
                        <th>Available Facilities & Amenities :</th>
                        <td>
                            <?php if(count($facilities['infrastructure']) > 0):?>
                                <?php foreach($facilities['infrastructure'] as $infrastructure):?>
                                    <?= $infrastructure['sports_infrastructure_name']?>,
                                <?php endforeach?>
                            <?php endif?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12 text-center m_bot20">
                <a class="btn btn-main btn_select" href="<?= base_url()?>check-available-rate/<?= $facilities['sports_facilities_id']?>">Check Availability & Rate</a>
            </div>
            <div class="col-sm-12 text-center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.525186762932!2d87.32271771495527!3d22.333790085306124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a1d443f15b91a47%3A0x2e2cd8d8865f202a!2sSERSA%20Stadium!5e0!3m2!1sen!2sin!4v1653592015656!5m2!1sen!2sin"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
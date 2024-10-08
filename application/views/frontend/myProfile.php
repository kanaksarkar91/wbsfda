<?php
// print_r($customer_details);
?>
<section class="gray">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="dashboard-navbar dashboard-left-content">

                    <div class="d-user-avater">
                        <img src="<?= !is_null($this->session->userdata('profile_pic')) ? base_url('public/customer_images/' . $this->session->userdata('profile_pic')) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" class="img-fluid avater w-75" alt="">
                        <h5 class="fw-bold thm-txt mt-3"><?=$this->session->userdata('first_name')?> </h5>
                        <span></span>
                    </div>

                    <div class="d-navigation">
                        <ul class="dashboard-list">
                            <li class="list active"><a href="my-profile.html"><i class="bi bi-person-fill"></i> My Profile</a></li>
                            <li class="list"><a href="my-booking.html"><i class="bi bi-clipboard2-check-fill"></i> My Booking</a></li>
                            <li class="list"><a href="index.html"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="dashboard-wraper single-reservation bg-white base-padding">
				<?php if ($this->session->flashdata('success_msg')) : ?>
				   <div class="alert alert-success">
						 
						<?= $this->session->flashdata('success_msg') ?>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('error_msg')) : ?>
					<div class="alert alert-danger">
						
						<?= $this->session->flashdata('error_msg') ?>
					</div>
				<?php endif ?>
                    <!-- Basic Information -->
                    <div class="form-submit">
                        <h5 class="fw-bold thm-txt mb-4">My Account</h5>
                        <form action="<?= base_url('update-profile') ?>" method="post" id="update_profile" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
							<input type="hidden" class="form-control" name="customer_id" value="<?= $customer_details['customer_id'] ?>">

                            <div class="submit-section">
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label>Full Name<i class="req">*</i></label>
                                        <input type="text" class="form-control text_capitalized" name="first_name" value="<?= $customer_details['first_name']; ?>">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label>Gender<i class="req">*</i></label>
                                        <select class="form-select" name="gender">
											<option value="Male" <?= set_select('gender', 'Male', $customer_details['gender'] == 'Male' ? true : false); ?>>Male</option>
											<option value="Female" <?= set_select('gender', 'Female', $customer_details['gender'] == 'Female' ? true : false); ?>>Female</option>
											<option value="Other" <?= set_select('gender', 'Other', $customer_details['gender'] == 'Other' ? true : false); ?>>Transgender</option>
										</select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Age<i class="req">*</i></label>
                                        <select class="form-select" name="age" >
											<?php for ($i = 18; $i <= 120; $i++) { ?>
											<option value="<?= $i; ?>" <?= set_select('age', $i, $customer_details['age'] == $i ? true : false); ?>><?= $i; ?></option>
											<?php } ?>
										</select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Email<i class="req">*</i></label>
                                        <input type="email" class="form-control" name="email" value="<?= $customer_details['email'] ?>" readonly="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Phone<i class="req">*</i></label>
                                        <input type="text" class="form-control" name="mobile" value="<?= $customer_details['mobile'] ?>" readonly="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Your Address<i class="req">*</i></label>
                                        <input type="text" class="form-control" name="address" value="<?= $customer_details['address'] ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>City / Village<i class="req">*</i></label>
                                        <input type="text" class="form-control" name="city" value="<?= $customer_details['city'] ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Country<i class="req">*</i></label>
                                        <select id="country_id" name="country_id" class="form-select">
                                            <option value="">Select Country</option>
                                            <?php foreach ($countries as $country) { ?>
                                                <option value="<?= $country['country_id'] ?>" <?= ($country['country_id'] == $customer_details['country_id']) ? 'selected' : '' ?>><?= $country['country_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>State<i class="req">*</i></label>
                                        <select id="state_id" name="state_id" class="form-select">
                                            <option value="">Select State</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Pincode<i class="req">*</i></label>
                                        <input type="text" class="form-control" name="pincode" value="<?= $customer_details['pincode'] ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Profile Image</label>
                                        <img src="<?= !is_null($customer_details['profile_pic']) ? base_url('public/customer_images/' . $customer_details['profile_pic']) : base_url('public/frontend_assets/images/user-icon.jpg') ?>" id="profile_pic_img" alt="" class="img-fluid avater" height="78" width="78">
                                        <input type="file" class="form-control" accept="image/*" id="profile_pic" name="profile_pic" style="display:none;" capture>
                                    </div>


                                    <div class="clearfix w-100"></div>

                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn-green">Update Changes</button>
                                    </div>


                                    <?= $this->session->flashdata('success_msg') ?>
                                </div>
                            <?php endif ?>
                            <?php if ($this->session->flashdata('error_msg')) : ?>
                                <div class="alert alert-danger">

                                    <?= $this->session->flashdata('error_msg') ?>
                                </div>
                            <?php endif ?>
                            <!-- Basic Information -->
                            <div class="form-submit">
                                <h5 class="fw-bold thm-txt mb-4">My Account</h5>
                                <form action="<?= base_url('update-profile') ?>" method="post" id="update_profile" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" class="form-control" name="customer_id" value="<?= $customer_details['customer_id'] ?>">

                                    <div class="submit-section">
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Full Name<i class="req">*</i></label>
                                                <input type="text" class="form-control text_capitalized" name="first_name" autocomplete="off" value="<?= $customer_details['first_name'] ?>">
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label>Gender<i class="req">*</i></label>
                                                <select class="form-control" name="gender">
                                                    <option value="Male" selected="selected">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Transgender</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Age<i class="req">*</i></label>
                                                <select class="form-select" name="age">
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                    <option value="32">32</option>
                                                    <option value="33">33</option>
                                                    <option value="34">34</option>
                                                    <option value="35">35</option>
                                                    <option value="36">36</option>
                                                    <option value="37">37</option>
                                                    <option value="38">38</option>
                                                    <option value="39">39</option>
                                                    <option value="40">40</option>
                                                    <option value="41">41</option>
                                                    <option value="42">42</option>
                                                    <option value="43">43</option>
                                                    <option value="44">44</option>
                                                    <option value="45">45</option>
                                                    <option value="46">46</option>
                                                    <option value="47">47</option>
                                                    <option value="48">48</option>
                                                    <option value="49">49</option>
                                                    <option value="50">50</option>
                                                    <option value="51">51</option>
                                                    <option value="52">52</option>
                                                    <option value="53">53</option>
                                                    <option value="54">54</option>
                                                    <option value="55">55</option>
                                                    <option value="56">56</option>
                                                    <option value="57">57</option>
                                                    <option value="58">58</option>
                                                    <option value="59">59</option>
                                                    <option value="60">60</option>
                                                    <option value="61">61</option>
                                                    <option value="62">62</option>
                                                    <option value="63">63</option>
                                                    <option value="64">64</option>
                                                    <option value="65">65</option>
                                                    <option value="66">66</option>
                                                    <option value="67">67</option>
                                                    <option value="68">68</option>
                                                    <option value="69">69</option>
                                                    <option value="70">70</option>
                                                    <option value="71">71</option>
                                                    <option value="72">72</option>
                                                    <option value="73">73</option>
                                                    <option value="74">74</option>
                                                    <option value="75">75</option>
                                                    <option value="76">76</option>
                                                    <option value="77">77</option>
                                                    <option value="78">78</option>
                                                    <option value="79">79</option>
                                                    <option value="80">80</option>
                                                    <option value="81">81</option>
                                                    <option value="82">82</option>
                                                    <option value="83">83</option>
                                                    <option value="84">84</option>
                                                    <option value="85">85</option>
                                                    <option value="86">86</option>
                                                    <option value="87">87</option>
                                                    <option value="88">88</option>
                                                    <option value="89">89</option>
                                                    <option value="90">90</option>
                                                    <option value="91">91</option>
                                                    <option value="92">92</option>
                                                    <option value="93">93</option>
                                                    <option value="94">94</option>
                                                    <option value="95">95</option>
                                                    <option value="96">96</option>
                                                    <option value="97">97</option>
                                                    <option value="98">98</option>
                                                    <option value="99">99</option>
                                                    <option value="100">100</option>
                                                    <option value="101">101</option>
                                                    <option value="102">102</option>
                                                    <option value="103">103</option>
                                                    <option value="104">104</option>
                                                    <option value="105">105</option>
                                                    <option value="106">106</option>
                                                    <option value="107">107</option>
                                                    <option value="108">108</option>
                                                    <option value="109">109</option>
                                                    <option value="110">110</option>
                                                    <option value="111">111</option>
                                                    <option value="112">112</option>
                                                    <option value="113">113</option>
                                                    <option value="114">114</option>
                                                    <option value="115">115</option>
                                                    <option value="116">116</option>
                                                    <option value="117">117</option>
                                                    <option value="118">118</option>
                                                    <option value="119">119</option>
                                                    <option value="120">120</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Email<i class="req">*</i></label>
                                                <input type="email" class="form-control" name="email" value="<?= $customer_details['email'] ?>" readonly="" autocomplete="off">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Phone<i class="req">*</i></label>
                                                <input type="text" class="form-control" name="mobile" value="<?= $customer_details['mobile'] ?>" readonly="" autocomplete="off">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Your Address<i class="req">*</i></label>
                                                <input type="text" class="form-control" name="address" value="<?= $customer_details['address'] ?>" autocomplete="off">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>City / Village<i class="req">*</i></label>
                                                <input type="text" class="form-control" name="city" value="<?= $customer_details['city'] ?>" autocomplete="off">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Country<i class="req">*</i></label>
                                                <select id="country_id" name="country_id" class="form-select">
                                                    <option value="">Select Country</option>
                                                    <?php foreach ($countries as $country) : ?>
                                                        <option value="<?= $country['country_id'] ?>" <?= $customer_details['country_id'] == $country['country_id'] ? 'selected' : '' ?>><?= $country['country_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>State<i class="req">*</i></label>
                                                <select id="state_id" name="state_id" class="form-select">
                                                    <option value="">Select State</option>

                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Pin Code<i class="req">*</i></label>
                                                <input type="text" class="form-control" name="pincode" value="<?= $customer_details['pincode'] ?>" autocomplete="off">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Profile Image</label>
                                                <img src="https://wbsfdc.devserv.in/public/frontend_assets/images/user-icon.jpg" id="profile_pic_img" alt="" class="img-fluid avater" height="78" width="78">
                                                <input type="file" class="form-control" accept="image/*" id="profile_pic" name="profile_pic" style="display:none;" capture="" autocomplete="off">
                                            </div>


                                            <div class="clearfix w-100"></div>

                                            <div class="form-group col-md-6">
                                                <button type="submit" class="btn-green">Update Changes</button>
                                            </div>


                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
</section>

<script>
    $(document).ready(function() {

        var country_id = "<?= ($customer_details['country_id']) ? $customer_details['country_id'] : '' ?>";
        var state_id = "<?= ($customer_details['state_id']) ? $customer_details['state_id'] : '' ?>";

        $("#profile_pic_img").click(function(e) {
            $("#profile_pic").click();
        });

        $('#country_id').change(function() {
            var country_id = $(this).val();
            $.ajax({
                url: '<?= base_url("frontend/profile/getstate"); ?>',
                method: 'post',
                data: {
                    country_id: country_id,
					csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
                },
                dataType: 'json',
                async: false,
                success: function(response) {
                    var resultHTML = '<option value="" selected>Select State</option>';
                    $.each(response, function(index, data) {

                        resultHTML += '<option value="' + data.state_id + '" ' + ((state_id == data.state_id) ? "selected" : "") + '>' + data.state_name + '</option>';

                    });
                    $('#state_id').html(resultHTML);
                }
            });
        });

        if (country_id) {
            $("#country_id").trigger("change");
        }


    });

    function fasterPreview(uploader, preview_div) {
        if (uploader.files && uploader.files[0]) {
            $('#' + preview_div).attr('src', window.URL.createObjectURL(uploader.files[0]));
        }
    }

    $("#profile_pic").change(function() {

        fasterPreview(this, 'profile_pic_img');
    });
</script>
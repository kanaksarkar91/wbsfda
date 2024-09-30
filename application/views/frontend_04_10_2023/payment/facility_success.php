<section class="section">
    <div class="container text-center">
        <!-- <h1 class="title">Proceed</h1> -->
    </div>
    <div style="width: 80%; margin:0 auto; padding-top: 30px;">
    	<div style="background: #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 18%);padding:20px; border-radius:8px;">
        	<div class="alert alert-success">Success</div>
        	<table class="table table-bordered table-hover">
                <tr>
                    <th>Transaction id</th>
                    <th>Mihpayid</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                </tr>
                <tbody>
                    
                    <tr>
                        <td><?php echo $payment['txnid']?></td>
                        <td><?php echo $payment['mihpayid']?></td>
                        <td><?php echo $payment['status']?></td>
                        <td><?php echo $payment['net_amount_debit']?></td>
                    </tr>
                </tbody>
            </table>   
            <div style=" margin-top:20px;">
            	<a href="<?php echo base_url('my-bookings')?>" class="btn btn_visitor_book">My Bookings</a>
            </div>
    	</div>
    </div>
</section>

<script type="text/javascript">
    
</script>

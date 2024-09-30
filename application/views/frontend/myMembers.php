<section class="section">
    <div class="container text-center">
        <h3>My Members</h3>
    </div>
    <div style="width: 80%; margin:0 auto; padding-top: 10px;">
    	<div style="background: #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 18%);padding:20px; border-radius:8px;">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Member Name</th>
                    <th>Member Relation</th>
                    <th>Division</th>
                    <th>Location</th>
                    <th>Gymnasium</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <tbody>
                    <?php if(isset($members) && $members): foreach($members as $member):?>
                        <tr>
                            <td><?= $member['member_name']?></td>
                            <td><?= $member['relation']?></td>
                            <td><?= $member['fieldunit_name']?></td>
                            <td><?= $member['location_name']?></td>
                            <td><?= $member['sports_facilities_name']?></td>
                            <td><span class="badge" style="background: #5cb85c;">
                                <?= ($member['status'] == 0)?'ACTIVE':'PENDING'?>
                            </span></td>
                            <td><a class="btn btn-sm btn-main" href="<?= base_url('member-subscription')?>/<?= $member['gymnasium_member_id']?>">VIEW SUBSCRIPTION</a></td>
                        </tr>
                    <?php endforeach; endif?>
                </tbody>
            </table>            
        </div>
    </div>
</section>
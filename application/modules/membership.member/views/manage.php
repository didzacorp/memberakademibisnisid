<script type="text/javascript">
$(function () {
        hideProgres();
        pageLoadMemberShip(1);
        $('#MemberName').html('');
  });
  function pageLoadMemberShip(pg)
  { 
    showProgres();
    $.post(base_url(1)+'/membership.member/manage/page/'+pg
      ,{
        id_member :$('#id_member').val()
      }
      ,function(result) {
        $('#resultContent').show();
        $('#upgradeMemberContent').hide();
        $('#resultContent').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }



  function upgradeMember()
  { 
    showProgres();
    $.post(base_url(1)+'/membership.member/manage/upgradeMember'
      // ,{
      //   id_member :$('#id_member').val()
      // }
      ,function(result) {
        $('#resultContent').hide();
        $('#upgradePaymentContent').hide();
        $('#upgradeMemberContent').show();
        $('#upgradeMemberContent').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }

  function upgradePayment(idTrans)
  { 
    showProgres();
    $.post(base_url(1)+'/membership.member/manage/upgradePayment'
      ,{
        idTrans : idTrans
      }
      ,function(result) {
        $('#resultContent').hide();
        $('#upgradeMemberContent').hide();
        $('#upgradePaymentContent').show();
        $('#upgradePaymentContent').html(result);
        hideProgres();
      }         
      ,"html"
    );
  }

  function backTolist() {
      $('#resultContent').show();
      $('#upgradeMemberContent').hide();
      $('#upgradePaymentContent').hide();
      pageLoadMemberShip(1);
  }

  function UpgradeLisence(id) {
    showProgres();
    $.post(base_url(1)+'/membership.member/manage/UpgradeLisence'
      ,{
        id : id
      }
      ,function(result) {
        if (result.error) {
            showDangerToast(result.error);
        }else{
            showSuccessToast(result.message);
            upgradePayment(result.idTrans);
        }
      }         
      ,"json"
    );
  }

  // function DetailUpline(id_member)
  // { 
  //   showProgres();
  //   $.post(base_url(1)+'/membership.member/manage/DetailMember'
  //     ,{
  //     	id_member :$('#id_member').val()
  //     }
  //     ,function(result) {
  //       $('#resultContent').html(result);
  //       hideProgres();
  //     }         
  //     ,"html"
  //   );
  // }
</script>
<input type="hidden" name="id_member" id="id_member">
 <div class="content-wrapper">


  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">

      <div class="card">
        <div class="card-body">
          <h4 class="card-title" > 
          	<a href="javascript:void(0)" onclick="loadMainContentMember('/membership.member/manage');">My <?=$title?></a> 
          	<span id="MemberName" style="font-size: 12px;"></span>
          </h4>
          <div classs="row">
          	<div class="col-md-12">
          		<div id="resultContent"></div>
              <div id="upgradeMemberContent"></div>
              <div id="upgradePaymentContent"></div>
		    	</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

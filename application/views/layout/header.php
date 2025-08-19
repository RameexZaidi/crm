<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta name="description" content="Miminium Admin Template v.1">
	<meta name="author" content="Isna Nur Azis">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM</title>
 
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/asset/css/bootstrap.min.css">

      <!-- plugins -->
      <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/asset/css/plugins/font-awesome.min.css"/>
      <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/asset/css/plugins/simple-line-icons.css"/>
      <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/asset/css/plugins/animate.min.css"/>
      <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/asset/css/plugins/fullcalendar.min.css"/>
	<link href="<?= base_url() ?>/asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->
<!-- Datatable -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/asset/css/plugins/datatables.bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Datatable -->
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

 <body id="mimin" class="dashboard">
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
                <a href="index.html" class="navbar-brand"> 
                 <b>INN-NEXUM</b>
                </a>

              <ul class="nav navbar-nav search-nav">
               
              </ul>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span><?= $this->session->userdata('u_name') ?></span></li>
                  <li class="dropdown avatar-dropdown" style="margin-left: -20px;">
                   <img src="<?= base_url() ?>/asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                 <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
                     <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li>
                     <li role="separator" class="divider"></li>
                     <li class="more">
                      <ul>
                        <li><a href=""><span class="fa fa-cogs"></span></a></li>
                        <li><a href=""><span class="fa fa-lock"></span></a></li>
                        <li><a href="<?= site_url('Auth/logout') ?>"><span class="fa fa-power-off "></span></a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->
           <?php 
  $role = $this->session->userdata('role'); 
 
?>

<?php 
  $role = $this->session->userdata('role'); 
?>
<style>
    
</style>
<div id="left-menu">
  <div class="sub-left-menu scroll">
    <ul class="nav nav-list">
  <li><div class=""></div></li>

  <?php if (!in_array($role, ['agent', 'qualifier', 'closer','report_manager','super_agent'])): ?>

  <!-- Admin/Manager Dashboard -->
  <li class="active ripple">
    <a class="tree-toggle nav-header"><span class="fa fa-tachometer-alt"></span> Dashboard 
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
        <li><a href="<?= site_url('Dashboard') ?>">Dashboard</a></li>
    </ul>
  </li>

  <!-- Group -->
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-people-group"></span> Group
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('Group') ?>">Create Group</a></li>
      <li><a href="<?= site_url('Group/GroupListing') ?>">Group List</a></li>
    </ul>
  </li>
  
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-file-alt"></span> Blank Leads
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('BlankLead') ?>">Create Blank Leads</a></li>
      <li><a href="<?= site_url('BlankLead/GetBlankLead') ?>">Blank Leads Listing</a></li>
    </ul>
  </li>

  <!-- Deals -->
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-money-bill-wave"></span> Deals
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('Deal') ?>">All Deals</a></li>
      <li><a href="<?= site_url('Deal/ApproveDeals') ?>">Approve Deals</a></li>
    </ul>
  </li>

  <!-- Leads Management -->
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-tasks"></span> Leads Management
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('LeadMnagement') ?>">CC Leads (A)</a></li>
      <li><a href="<?= site_url('LeadMnagement/Lead_B_Type') ?>">CC Leads (B)</a></li>
    </ul>
  </li>

  <!-- Leads Uploading -->
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-file-upload"></span> Leads Uploading
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('LeadUploading') ?>">Leads Uploading</a></li>
    </ul>
  </li>

  <!-- Leads Assign -->
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-clipboard-list"></span> Leads Assign
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('LeadAssign/Assign') ?>">Lead Assign</a></li>
      <li><a href="<?= site_url('LeadAssign/AssignLeadList') ?>">View Assign Leads</a></li>
      <li><a href="<?= site_url('LeadAssign/UnAssignLeadList') ?>">View UnAssign</a></li>
    </ul>
  </li>

  <!-- Manage Agents -->
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-user-cog"></span> Manage Agents
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('Agent') ?>">Create Agents</a></li>
      <li><a href="<?= site_url('Agent/AgentListing') ?>">Agents Listing</a></li>
      <li><a href="<?= site_url('Agent/UserListing') ?>">User Listing</a></li>
    </ul>
  </li>
  
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-user-cog"></span> Reports Listing
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="#">View Report Request</a></li>
      <li><a href="<?= site_url('Report/UploadedReport') ?>">Uploaded Report</a></li>
      <li><a href="#">Report Changes</a></li>
    </ul>
  </li>

  <?php endif; ?>

  <!-- For Agent, Closer, Qualifier only -->
  <?php if (in_array($role, ['agent', 'qualifier', 'closer','super_agent'])): ?>
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-tasks"></span> My Panel
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('LeadsProcess') ?>">Today Leads</a></li>
      <li><a href="<?= site_url('LeadsProcess/PreviousLeads') ?>">Previous Leads</a></li>
      <li><a href="<?= site_url('BlankLead') ?>">Blanks Lead</a></li>
      <li><a href="<?= site_url('BlankLead/GetBlankLead') ?>">Blanks Leads Listing</a></li>
    </ul>
  </li>

  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-file-alt"></span> Reports
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('Report/UploadedReport') ?>">Change Request</a></li>
      <li><a href="<?= site_url('Report/ReportRequest') ?>">View Reports</a></li>
    </ul>
  </li>

  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-chart-line"></span> Working Stats
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('LeadsProcess') ?>">Lead In Process</a></li>
      <li><a href="<?= site_url('LeadsProcess/PreviousLeads') ?>">Complete Leads</a></li>
    </ul>
  </li>
  <?php endif; ?>

  <!-- Manage Reports (Only for report_manager) -->
  <?php if ($role === 'report_manager'): ?>
  <li class="ripple">
    <a class="tree-toggle nav-header">
      <span class="fa fa-file-signature"></span> Manage Reports
      <span class="fa-angle-right fa right-arrow text-right"></span>
    </a>
    <ul class="nav nav-list tree">
      <li><a href="<?= site_url('Report') ?>">View Report Request</a></li>
      <li><a href="<?= site_url('ChangeRequest/ViewChangeRequest') ?>">View Report Change Request</a></li>
      <li><a href="<?= site_url('Report/UploadedReport') ?>">Uploaded Reports</a></li>
    </ul>
  </li>
  <?php endif; ?>

  <!-- Notepad (Visible to All) -->
  <li class="ripple">
    <a href="<?= site_url('Notepad') ?>">
      <span class="fa fa-sticky-note"></span> Notepad
    </a>
  </li>
</ul>

  </div>
</div>


          <!-- end: Left Menu -->
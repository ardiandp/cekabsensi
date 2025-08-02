<?php 
$pageTitle = "Dashboard";
$currentPage = "dashboard";
include 'includes/header.php'; 
include 'includes/sidebar.php';
?>

<div class="content">
    <div class="container-fluid">
        <h2 class="mb-4">Dashboard</h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <h2 class="card-text">125</h2>
                        <p class="text-muted"><i class="fas fa-arrow-up text-success"></i> 5.2% from last month</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Today's Attendance</h5>
                        <h2 class="card-text">89</h2>
                        <p class="text-muted"><i class="fas fa-arrow-down text-danger"></i> 2.1% from yesterday</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Requests</h5>
                        <h2 class="card-text">7</h2>
                        <p class="text-muted"><i class="fas fa-arrow-up text-success"></i> 1 new today</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                Recent Activity
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>Checked in</td>
                                <td>10 minutes ago</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td>Updated profile</td>
                                <td>25 minutes ago</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mike Johnson</td>
                                <td>Checked out</td>
                                <td>1 hour ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
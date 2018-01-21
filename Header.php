


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand " href="#page-top">Let's Educate Each Other</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="Find.php" role="button" aria-haspopup="true" aria-expanded="false">Find</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="Find.php">Find TutorClass</a>
                        <a class="dropdown-item" href="createclass.php">Create a Class</a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="Q&A.php">Q&A</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="articles.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="Contact.php">Contact</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">$username</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../SaifMuntaser/viewProfile.php?user_id=<?= $_SESSION['user_id']; ?>">Profile</a>
                        <a class="dropdown-item" href="../SaifMuntaser/edit_profile.php?user_id=<?= $_SESSION['user_id']; ?>">Edit Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../SaifMuntaser/logout.php">Logout</a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>



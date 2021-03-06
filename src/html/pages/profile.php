<?php include_once('html/common/templates.php'); ?>

<div class="page-margin">
    <section id="profile-main" class="card grid-profile container-lg">
        <div class="one">
            <h3 class="nickname my-4">joaquina123</h3>
            <div class="profile-pic col-md mb-4">
                <img class="rounded-circle img-thumbnail" src="images/profile.png" alt="Profile Image">
            </div>
        </div>
        <div class="two row mt-4">
            <section class="profile-info col-md mb-4">
                <h3>Personal</h3>
                <p><span class="profile-small-title"><i class="fas fa-user"></i> Name:</span> Maria Joaquina</p>
                <p><span class="profile-small-title"><i class="fas fa-at"></i> E-mail:</span> up201806230@fe.up.pt</p>
                <p><span class="profile-small-title"><i class="fa fa-calendar" aria-hidden="true"></i> Birthday:</span> 09/02/1997</p>
            </section>

            <section class="profile-about-me col-md mb-4">
                <h3>About Me</h3>
                <p>Hello! It's Joaquina! I'm currently studying Informatic Engineering (MIEIC) at FEUP. My dream is to work at google and become a great software engineer. I love dogs and cats, I hope I love you too.</p>
            </section>
        </div>
        <section class="three profile-academic-info">
            <div class="row">
                <section class="col-md mb-4">
                    <h3>Academic Information</h3>
                    <p><span class="profile-small-title"><i class="fas fa-graduation-cap"></i> Course:</span>MIEIC</p>
                    <p><span class="profile-small-title"><i class="fa fa-calendar" aria-hidden="true"></i> Current year:</span> 3rd</p>
                    <div>
                        <p><span class="profile-small-title"><i class="fas fa-tags"></i>Tags:</span>
                            <span class="category tag badge bg-secondary"> 
                                <i class="fas fa-hashtag"></i>
                                MIPS
                            </span>
                            <span class="category tag badge bg-secondary">
                                <i class="fas fa-hashtag"></i>
                                COMP
                            </span>
                        </p>
                    </div>
                </section>
                <div class="col-md d-flex justify-content-end align-items-end">
                    <a class="btn btn-primary my-2" href="edit-profile.php">Edit Profile</a>
                </div>
            </div>
        </section>
    </section>

    <ul id="main-pagination" class="pagination justify-content-center" >
        <li class="page-item page-question active"><button id="pagination-button-1" class="page-link">My Questions</button></li>
        <li class="page-item page-answer"><button id="pagination-button-2" class="page-link">My Answers</button></li>
    </ul>

    <section id="pagination-item-1" class="container-lg mt-5 profile-questions-preview px-0">
        <h3 class="mb-4">My Questions</h3>
        <?php questionPreview(); ?>
        <ul id="pagination-questions" class="pagination justify-content-center">
            <li class="page-item page-1 active"><button class="page-link">1</button></li>
            <li class="page-item page-2"><button class="page-link">2</button></li>
            <li class="page-item page-3"><button class="page-link">3</button></li>
        </ul>
    </section>

    <section id="pagination-item-2" class="container-lg mt-5 profile-questions-preview px-0">
        <h3 class="mb-4">My Answers</h3>
        <?php answerPreview(); ?>
        <ul id="pagination-answers" class="pagination justify-content-center profile-answers">
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
        </ul>
    </section>

</div>
<?php
session_start();
include "config.php"; // Your database connection
include_once "header.php"; // Your site header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Criteria - Sargodha Medical Collage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #800000; /* Maroon */
            --secondary-color: #660000; /* Darker Maroon */
            --light-gray: #f9f9f9;
            --dark-text: #333;
            --light-text: #666;
            --border-color: #ddd;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-text);
            line-height: 1.7;
        }

        /* Hero Section for Admission Criteria */
        .admission-hero {
            position: relative;
            height: 50vh; /* Adjust height as needed */
            background: url('images/smcbuliding.png') no-repeat center center/cover; 
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-top: -1px;
        }

        .admission-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }

        .admission-hero h1 {
            font-size: 3.8em;
            font-weight: 700;
            z-index: 2;
            position: relative;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
        }

        .section-title {
            color: var(--primary-color);
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .criteria-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-bottom: 30px;
        }

        .criteria-card h3 {
            color: var(--primary-color);
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
            position: relative;
        }

        .criteria-card h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 50px;
            height: 2px;
            background-color: var(--secondary-color);
            border-radius: 1px;
        }

        .criteria-card p {
            font-size: 1.05em;
            color: var(--dark-text);
            margin-bottom: 15px;
        }

        .criteria-card ul {
            list-style: disc;
            padding-left: 25px;
            margin-bottom: 15px;
            color: var(--light-text);
        }

        .criteria-card ul li {
            margin-bottom: 8px;
            font-size: 1em;
        }
        
        .criteria-card .note {
            font-style: italic;
            color: #888;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed var(--border-color);
        }

        .criteria-disclaimer {
            font-size: 0.9em;
            color: #888;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px dashed var(--border-color);
            font-style: italic;
            text-align: center;
        }

        /* Tabs Styling */
        .nav-pills .nav-link {
            color: var(--dark-text);
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 8px;
            transition: all 0.3s ease;
            list-style-type: none; 
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .tab-content {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .admission-hero h1 {
                font-size: 3em;
            }
            .criteria-card {
                padding: 25px;
            }
            .criteria-card h3 {
                font-size: 1.6em;
            }
        }

        @media (max-width: 767.98px) {
            .admission-hero {
                height: 30vh;
            }
            .admission-hero h1 {
                font-size: 2.5em;
            }
            .section-title {
                font-size: 2.2em;
                margin-bottom: 30px;
            }
            .criteria-card {
                padding: 20px;
            }
            .criteria-card h3 {
                font-size: 1.4em;
            }
            .criteria-card p, .criteria-card ul li {
                font-size: 0.95em;
            }
            .nav-pills {
                flex-direction: column; /* Stack pills on small screens */
                align-items: center;
            }
            .nav-pills .nav-item {
                width: 100%; /* Make pills full width on mobile if stacked */
                text-align: center;
            }
            .nav-pills .nav-link {
                width: 100%; /* Make pills full width on mobile if stacked */
                margin-bottom: 8px; /* Add space between stacked pills */
            }
        }
    </style>
</head>
<body>

<div class="admission-hero">
    <h1>Admission Criteria</h1>
</div>

<div class="container py-5">
    <div class="criteria-card">
        <ul class="nav nav-pills justify-content-center mb-4" id="admissionTabs" role="tablist">
            <li class="nav-item" role="presentation" style="list-style-type: none;">
                <button class="nav-link active" id="undergraduate-tab" data-bs-toggle="pill" data-bs-target="#undergraduate" type="button" role="tab" aria-controls="undergraduate" aria-selected="true">
                    Undergraduate Programs
                </button>
            </li>
            <li class="nav-item" role="presentation" style="list-style-type: none;">
                <button class="nav-link" id="postgraduate-tab" data-bs-toggle="pill" data-bs-target="#postgraduate" type="button" role="tab" aria-controls="postgraduate" aria-selected="false">
                    Postgraduate Programs
                </button>
            </li>
        </ul>

        <div class="tab-content" id="admissionTabsContent">
            <div class="tab-pane fade show active" id="undergraduate" role="tabpanel" aria-labelledby="undergraduate-tab">
                <h2 class="section-title">Undergraduate Programs</h2>

                <h3>B.Sc. (Hons.) Allied Health Sciences (4 years)</h3>
                <p>Entry level for all B.Sc. Allied Health Sciences Programs should be uniform and it shall be F.Sc. Pre-Medical or F.Sc. in relevant technology from a Board of Intermediate & Secondary Education / equivalent (as determined by the Inter Board Committee of Chairmen, Islamabad), with at least <strong>50 % unadjusted marks</strong>, w.e.f. academic year 2010.</p>
                <p>There shall be no age restriction for admission in B.Sc. (Hons.) Allied Health Sciences courses.</p>

                <h3 class="mt-4">B.Sc. Nursing (4 years)</h3>
                <ul>
                    <li>Selection will be purely on merit.</li>
                    <li>Requisite qualification: F.Sc. Pre-medical (with at least <strong>50% unadjusted marks</strong>).</li>
                    <li>Age limit shall be 17 to 25 years.</li>
                    <li>The decision of selection board / committee of respective institution will be final.</li>
                </ul>

                <h3 class="mt-4">B.Sc. Nursing (2 years)</h3>
                <ul>
                    <li>Diploma in General Nursing registered with Pakistan Nursing Council.</li>
                    <li>Diploma in Midwifery / for male nurses 1-year specialized course registered with Pakistan Nursing Council.</li>
                    <li>Minimum of <strong>02 years’ experience</strong>.</li>
                    <li>Age limit & gender not applicable.</li>
                    <li>Admission test, interview by the Institute concerned.</li>
                </ul>
            </div>

            <div class="tab-pane fade" id="postgraduate" role="tabpanel" aria-labelledby="postgraduate-tab">
                <h2 class="section-title">Postgraduate Programs</h2>

                <h3>MS/MD</h3>
                <ul>
                    <li>MBBS/equivalent qualification registered with PMDC.</li>
                    <li>Completed one year House Job, with at least six months in the particular discipline.</li>
                    <li>One-year experience in particular specialty/Internal Medicine or General Surgery* /Allied medical or surgical discipline* in the given order of preference (as the case may be).</li>
                    <li>Passed Entry Test conducted by the University & aptitude interview by the Institute concerned.</li>
                </ul>
                <p class="note"><strong>Note:</strong></p>
                <ul>
                    <li>4 years for MS (General Surgery) & MD (Internal Medicine).</li>
                    <li>5 years for MS and MD in specialties.</li>
                </ul>

                <h3 class="mt-4">MDS</h3>
                <ul>
                    <li>BDS/equivalent qualification registered with PMDC.</li>
                    <li>Completed one year House Job.</li>
                    <li>Passed Entry Test & interview.</li>
                </ul>

                <h3 class="mt-4">M.Phil</h3>
                <p>To be eligible for admission to M. Phil., a candidate shall possess an MBBS / BDS degree. Any other higher degree e.g., M.Sc. in relevant field can be recognized by the University as equivalent, to aforementioned degrees. This shall only apply to very distinguished or outstanding candidates.</p>
                <p>Admissions shall be made on the basis of merit in accordance with the following criteria:</p>
                <ul>
                    <li><strong>60%</strong> Qualifications with previous academic record & relevant experience.</li>
                    <li><strong>10%</strong> Entry Test.</li>
                    <li><strong>30%</strong> Interview.</li>
                </ul>

                <h3 class="mt-4">M.Sc. Nursing</h3>
                <p>Eligibility to the program:</p>
                <ul>
                    <li>Bachelor of Science in Nursing, from recognized institution/affiliated to a University approved by HEC.</li>
                    <li>Minimum 1 year clinical or nursing administration experience.</li>
                    <li>Open domicile.</li>
                    <li>Open gender.</li>
                    <li>Entrance Test (English language, Mathematics, Aptitude test, General/current events).</li>
                </ul>
                <p class="note"><strong>NOTE:</strong></p>
                <ul>
                    <li>Only those candidates who pass the entrance test shall be eligible to appear in interview.</li>
                </ul>

                <h3 class="mt-4">M.Sc. Medical Laboratory Technology</h3>
                <ul>
                    <li>First or high 2nd division in B.Sc. Medical Laboratory Technology/B.Sc. (Hons.) Chemistry/Biology/ Biotechnology/MBBS.</li>
                    <li>Entry Test/Interview.</li>
                </ul>
                
                <h3 class="mt-4">Postgraduate Clinical Diplomas (2 years)</h3>
                <p><strong>General Requirements for all Postgraduate Clinical Diplomas:</strong> MBBS/equivalent qualification registered with PMDC and fulfillment of one of the following criteria, in given order of preference:</p>
                
                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DA (Diploma in Anesthesiology)</h4>
                <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                 <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DA (2 years):</em></p>
                <ul>
                    <li>Diploma in Midwifery/for male nurses 1 year specialized course registered with Pakistan Nursing Council.</li>
                    <li>Minimum of 02 years’ experience.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">Dip. Card. (Diploma in Cardiology)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for Dip. Card. (2 years):</em></p>
                <ul>
                    <li>One year experience in General Medicine as Medical Officer or House Officer.</li>
                    <li>Six months experience in the Cardiology and six months in allied specialty as Medical Officer or House Officer.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DCH (Diploma in Child Health)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DCH (2 years):</em></p>
                <ul>
                    <li>One year experience in Paediatrics as Medical Officer or House Officer.</li>
                    <li>Six months experience in Paediatrics and six months in allied specialty as Medical Officer or House Officer.</li>
                    <li>One year experience in General Medicine as Medical Officer or House Officer.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DCP (Diploma in Clinical Pathology)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DCP (2 years):</em></p>
                <ul>
                    <li>One year experience in Pathology as a Demonstrator in a recognized teaching institution.</li>
                    <li>Six months experience in Pathology as a Demonstrator and six months house job in one of the major clinical disciplines (Medicine/Surgery/ Gynae. & Obst.).</li>
                    <li>Two years experience of working in a reputable accredited Pathology lab with all 4 pathology disciplines, belonging to non-teaching institution.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DGO (Diploma in Gynaecology & Obstetrics)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DGO (2 years):</em></p>
                <ul>
                    <li>One year experience in Gynecology & Obstetrics as Medical Officer or House Officer.</li>
                    <li>Six months experience in Gynecology & Obstetrics and six months in allied specialty as Medical Officer or House Officer.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DLO (Diploma in Laryngology & Otology - ENT)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DLO (2 years):</em></p>
                <ul>
                    <li>One year experience in ENT as Medical Officer or House Officer.</li>
                    <li>Six months experience in ENT and six months in allied specialty as Medical Officer or House Officer.</li>
                    <li>One year experience in Surgery as Medical Officer or House Officer.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DMJ (Diploma in Medical Jurisprudence)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DMJ (2 years):</em></p>
                <ul>
                    <li>Two years experience as Demonstrator in the Department of Forensic Medicine & Toxicology of a Medical College recognized by PMDC.</li>
                    <li>Four years experience as Casualty Medical Officer in a Govt. DHQ/THQ Hospital allied specialty as Medical Officer or House Officer.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DMRD (Diploma in Medical Radiodiagnosis)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DMRD (2 years):</em></p>
                <ul>
                    <li>One year experience in Radiology as Medical Officer or House Officer from a recognized institution.</li>
                    <li>Six months experience in Radiology and six months in General Medicine/Surgery as Medical Officer or House Officer.</li>
                </ul>
                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DMRT (Diploma in Medical Radiotherapy)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DMRT (2 years):</em></p>
                <ul>
                    <li>One year experience in Radiotherapy as Medical Officer or House Officer from a recognized institution.</li>
                    <li>Six months experience in Radiotherapy and six months in General Medicine/Surgery as Medical Officer or House Officer.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DOMS (Diploma in Ophthalmic Medicine & Surgery)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DOMS (2 years):</em></p>
                <ul>
                    <li>One year experience in Ophthalmology as Medical Officer or House Officer from a recognized institution.</li>
                    <li>Six months experience in Ophthalmology and six months in General Medicine/Surgery as Medical Officer or House Officer.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DPM (Diploma in Psychological Medicine)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DPM (2 years):</em></p>
                <ul>
                    <li>One year experience in Psychiatry as Medical Officer or House Officer from a recognized institution.</li>
                    <li>Six months experience in Psychiatry and six months in General Medicine as Medical Officer or House Officer.</li>
                    <li>One year experience in General Medicine as Medical Officer or House Officer.</li>
                </ul>

                <h4 class="mt-4" style="color: var(--dark-text); font-weight: 600;">DTCD (Diploma in Tuberculosis & Chest Diseases)</h4>
                 <ul>
                    <li>Securing pass %age in the Entry Test as determined by UHS and qualifying the interview successfully.</li>
                </ul>
                <p style="font-size: 0.95em; color: var(--light-text);"><em>Specific criteria for DTCD (2 years):</em></p>
                <ul>
                    <li>One year experience in TB & Chest Diseases as Medical Officer or House Officer from a recognized institution.</li>
                    <li>Six months experience in TB & Chest Diseases and six months in General Medicine as Medical Officer or House Officer.</li>
                    <li>One year experience in General Medicine as Medical Officer or House Officer.</li>
                </ul>
            </div>
        </div>

        <p class="criteria-disclaimer">
            <i class="fas fa-info-circle me-2"></i> Disclaimer: The admission criteria provided here are based on general UHS guidelines. For the most accurate, up-to-date, and program-specific requirements, please refer to the official University of Health Sciences (UHS) prospectus and website for the current admission cycle.
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
// Close the database connection
$con->close();
// Include your footer file
include_once "footer.php";
?>
</body>
</html>
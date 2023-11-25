<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
   <style>
      /* Page Style */
      @page {
         font-family: Arial, sans-serif;
         margin: 1em 6em 1em 6em;
         size: letter;
      }

      body {
         margin: 5em 0;
      }

      /* Page Break */
      hr {
         page-break-after: always;
         border: 0;
      }

      /* Header */
      .vertical-line {
         border-left: 3px solid #333;
         height: 70px;
         margin: 0 20px;
         position: fixed;
         top: 5;
         left: 140;
      }

      #header {
         display: flex;
         flex-direction: row;
         position: fixed;
         top: 0;
         left: 0;
         right: 0;
      }

      #header .event-header {
         display: flex;
         flex-direction: row;
         text-align: start;
         position: fixed;
         top: 15;
         left: 170;
      }

      #header .event-name {
         font-weight: bold;
         font-size: 25px;
         line-height: 90%;
         color: #212529;
      }

      #header .sub-name {
         font-weight: bolder;
         font-style: italic;
         font-size: 14px;
         line-height: 90%;
      }

      #header .logo {
         position: fixed;
         top: 0;
         left: 0;
      }

      /* Title */
      .title {
         display: flex;
         flex-direction: column;
         text-align: center;
         margin-top: 15px;
         font-weight: bold;
         font-size: 18px;
      }

      /* Table */
      .table {
         text-align: center;
         margin-top: 30px;
         font-size: 14px;
      }

      .table table {
         border-collapse: collapse;
         margin: 0 auto;
         width: 100%
      }

      .table table th,
      td {
         padding-top: 5px;
         padding-bottom: 5px;
         padding-left: 10px;
         padding-right: 10px;
         border: 0.5pt solid black;
      }

      .table table thead tr th {
         font-size: 16px;
      }

      .table table tr td.round-name {
         text-align: center;
         font-size: 18px;
         font-weight: bold;
      }

      .table tbody td:first-child {
         width: 20%;
      }

      /* Signature */
      .signature {
         margin-top: 15px;
         font-size: 12px;
      }

      .signature table {
         width: 100%;
      }

      .signature table tr td {
         border: none;
         text-align: left;
      }

      .signature table tr td .fill {
         text-align: center
      }

      .signature table tr td .fill .sub-line {
         font-size: 10px;
      }
   </style>
   <title>Event Results</title>
</head>

<body>
   {{-- Header --}}
   <div id="header">
      <div class="logo">
         <img src="{{ public_path('img/philsilat_pdf_logo.png') }}" style="width: 30%; height: auto;" />
      </div>
      <div class="vertical-line"></div>
      <div class="event-header">
         {{-- main name class --}}
         <div class="event-name">
            {{-- data  --}}
            <span class="event-title">Event Name</span>
         </div>
         {{-- office class --}}
         <div class="sub-name"><span class="event-date">Event Date</span> - <span class="venue">Venue</span></div>
      </div>
   </div>

   {{-- 1st Page Male Category --}}
   <div>
      {{-- Title --}}
      <div class="title">
         <div>PENCAK SILAT - TANDING COMPETITION</div>
         <div>MATCH RESULTS</div>
      </div>

      {{-- Elimination Table --}}
      <div class="table">
         <table>
            <tr>
               <td colspan="4" class="round-name">
                  Elimination
               </td>
            </tr>
            <thead>
               <tr>
                  <th>CATEGORY</th>
                  <th style="background-color: rgb(253, 70, 70);">RED</th>
                  <th style="background-color: rgb(90, 147, 251);">BLUE</th>
                  <th>REMARKS</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Male - Class E (54kg - 57kg)</td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 12</span>
                     </div>
                     <div>
                        <span class="name">Derla, Julius A.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>Male - Class E (54kg - 57kg)</td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 12</span>
                     </div>
                     <div>
                        <span class="name">Derla, Julius A.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>

      {{-- Quaterfinals Table --}}
      <div class="table">
         <table>
            <tr>
               <td colspan="4" class="round-name">
                  Quaterfinals
               </td>
            </tr>
            <thead>
               <tr>
                  <th>CATEGORY</th>
                  <th style="background-color: rgb(253, 70, 70);">RED</th>
                  <th style="background-color: rgb(90, 147, 251);">BLUE</th>
                  <th>REMARKS</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Male - Class E (54kg - 57kg)</td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 12</span>
                     </div>
                     <div>
                        <span class="name">Derla, Julius A.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>Male - Class E (54kg - 57kg)</td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 12</span>
                     </div>
                     <div>
                        <span class="name">Derla, Julius A.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>

      {{-- Semifinals Table --}}
      <div class="table">
         <table>
            <tr>
               <td colspan="4" class="round-name">
                  Semifinals
               </td>
            </tr>
            <thead>
               <tr>
                  <th>CATEGORY</th>
                  <th style="background-color: rgb(253, 70, 70);">RED</th>
                  <th style="background-color: rgb(90, 147, 251);">BLUE</th>
                  <th>REMARKS</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Male - Class E (54kg - 57kg)</td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 12</span>
                     </div>
                     <div>
                        <span class="name">Derla, Julius A.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>Male - Class E (54kg - 57kg)</td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 12</span>
                     </div>
                     <div>
                        <span class="name">Derla, Julius A.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>

      {{-- Finals Table --}}
      <div class="table">
         <table>
            <tr>
               <td colspan="4" class="round-name">
                  Finals
               </td>
            </tr>
            <thead>
               <tr>
                  <th>CATEGORY</th>
                  <th style="background-color: rgb(253, 70, 70);">RED</th>
                  <th style="background-color: rgb(90, 147, 251);">BLUE</th>
                  <th>REMARKS</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Male - Class E (54kg - 57kg)</td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 12</span>
                     </div>
                     <div>
                        <span class="name">Derla, Julius A.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>Male - Class E (54kg - 57kg)</td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 12</span>
                     </div>
                     <div>
                        <span class="name">Derla, Julius A.</span>
                     </div>
                  </td>
                  <td>
                     <div>
                        <span class="region">Region 9</span>
                     </div>
                     <div>
                        <span class="name">Ferreras, Vince Austin R.</span>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>

      {{-- Signature --}}
      <div class="signature">
         <table>
            <tr>
               <td>
                  <div>
                     <p>Prepared by:</p>
                     <br />
                     <div class="fill">
                        <span>______________________________</span>
                        <br />
                        <span class="sub-line">(Name and signature over printed name)</span>
                     </div>
                     <div class="fill">
                        <br>
                        <span>______________________________</span>
                        <br />
                        <span class="sub-line">(position)</span>
                     </div>
                  </div>
               </td>
               <td>
                  <div>
                     <p>Verified by:</p>
                     <br />
                     <div class="fill">
                        <span>______________________________</span>
                        <br />
                        <span class="sub-line">(Name and signature over printed name)</span>
                     </div>
                     <div class="fill">
                        <br>
                        <span>______________________________</span>
                        <br />
                        <span class="sub-line">(position)</span>
                     </div>
                  </div>
               </td>
            </tr>
         </table>
      </div>
   </div>
</body>

</html>

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
         margin: 1em 6em 0em 6em;
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

      .uc {
         text-transform: uppercase;
      }

      /* Table */
      .table {
         text-align: center;
         margin-top: 15px;
         font-size: 13px;
      }

      .table table {
         border-collapse: collapse;
         margin: 0 auto;
         width: 100%
      }

      .table table th {
         background-color: lightblue;
      }

      .table table td.medal-td {
         background-color: khaki;
      }

      .table table th,
      td {
         /* text-align: left; */
         padding-left: 10px;
         padding-right: 10px;
         border: 0.5pt solid black;
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
         {{-- event name --}}
         <div class="event-name">
            {{ $event->name }} {{ $event->id }}
         </div>
         {{-- date - venue --}}
         <div class="sub-name">{{ \Carbon\Carbon::parse($event->starts_at)->format('M. d, Y') }}
            - {{ $event->venue }}
         </div>
      </div>
   </div>

   {{-- Male Category --}}
   <div>
      {{-- Title --}}
      <div class="title">
         <div>PENCAK SILAT - <span class="uc">{{ $game->name }}</span> COMPETITION</div>
         <div><span class="uc">{{ $game->category->sex }}</span> CATEGORY</div>
         <div>FINAL OFFICIAL RESULT</div>
      </div>

      {{-- Table --}}
      <div class="table">
         <table>
            {{-- Class A --}}
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS A (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            {{-- Class B --}}
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS B (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            {{-- Class C --}}
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS C (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            {{-- Class D --}}
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS D (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS E (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS F (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
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

   {{-- page break --}}
   <hr />

   {{-- Table --}}
   <div>
      {{-- Title --}}
      <div class="title">
         <div>PENCAK SILAT - TANDING COMPETITION</div>
         <div>FEMALE CATEGORY</div>
         <div>FINAL OFFICIAL RESULT</div>
      </div>

      {{-- Table --}}
      <div class="table">
         <table>
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS A (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS B (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS C (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS D (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS E (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
               </tr>
            </tbody>
            <thead>
               <tr>
                  <th>MEDAL</th>
                  <th>CLASS F (OVER 42 KG UP TO 45 KG)</th>
                  <th>REGION</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="medal-td">GOLD</td>
                  <td>FERRERAS, VINCE AUSTIN R.</td>
                  <td>REGION 6</td>
               </tr>
               <tr>
                  <td class="medal-td">SILVER</td>
                  <td>DERLA, JULIUS A.</td>
                  <td>REGION CARAGA</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>SABANA, JOE LAWRENCE M.</td>
                  <td>REGION 7</td>
               </tr>
               <tr>
                  <td class="medal-td">BRONZE</td>
                  <td>DELA CRUZ, JUAN A.</td>
                  <td>REGION 1</td>
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

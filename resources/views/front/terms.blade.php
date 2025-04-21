@extends('layouts.front.common')

@section('meta')
    <title>Manage Users</title>
@endsection
@section('css')
    
@endsection
@section('js')
    
@endsection
@section('content')
<section class="term_condition_banner">
  <div class="term_condition_heading">
  <h1>Terms & Conditions</h1>
  </div>
</section>
<section class="term_condition_section">
  <div class="container">
    <h2>Terms & Conditions – My Boat Booker</h2>
    <h2>1. Introduction</h2>
    <p>Welcome to My Boat Booker, an online platform that connects boat owners with individuals looking to rent a boat. By accessing or using our website and services, you agree to these Terms & Conditions. Please read them carefully before listing a boat or making a booking.</p>
    <h2>2. Definitions</h2>
    <ul>
      <li>"Platform" – The My Boat Booker website and associated services.</li>
      <li>"User" – Any individual or entity using the platform, including boat owners and renters.</li>
      <li>"Owner" – A user who lists their boat for rental.</li>
      <li>"Renter" – A user who books a boat through the platform.</li>
      <li>"Rental Agreement" – The contract between a boat owner and renter outlining the terms of a rental.</li>
      <li>"Service Fees" – Fees charged by My Boat Booker for using the platform.</li>
    </ul>
    <h2>3. Use of the Platform</h2>
    <h3>3.1 Eligibility</h3>
    <p>To use My Boat Booker, you must:</p>
    <ul>
      <li>Be at least 18 years old.</li>
      <li>Have the legal authority to enter into contracts.</li>
      <li>Provide accurate and up-to-date account information.</li>
    </ul>
    <h3>3.2 Account Registration</h3>
    <p>Users must create an account to book or list boats. You are responsible for safeguarding your login credentials and all activities under your account.</p>
    <h3>3.3 Platform Role</h3>
    <p>My Boat Booker acts as an intermediary between boat owners and renters. We do not own, manage, or operate any boats listed on the platform. The rental agreement is directly between the owner and the renter.</p>
    <h3>3.4 Prohibited Uses of the Platform</h3>
    <p>Users agree not to:</p>
    <ul>
      <li>Misrepresent themselves or provide false information.</li>
      <li>Attempt to bypass the My Boat Booker payment system.</li>
      <li>Use the platform for illegal or fraudulent activities.</li>
      <li>Post false, misleading, or deceptive listings or reviews.</li>
      <li>Violate any local laws, boating regulations, or maritime safety rules.</li>
      <li>Use automated systems (e.g., bots) to interact with the platform.</li>
    </ul>
    <p>Violations may result in account suspension, termination, and legal action.</p>
    <h2>4. Boat Rentals</h2>
    <h3>4.1 Booking Process</h3>
    <ul>
      <li>Renters can browse available boats and submit booking requests to owners.</li>
      <li>Owners have full discretion to accept or decline requests.</li>
      <li>Once a booking is confirmed, renters must complete the payment through the platform.</li>
    </ul>
    <h3>4.2 Payments & Fees</h3>
    <ul>
      <li>Payments are securely processed through My Boat Booker.</li>
      <li>Service fees may apply to each transaction.</li>
      <li>Any additional costs (e.g., fuel, skipper fees) must be agreed upon between the renter and owner before finalising the booking.</li>
    </ul>
    <h3>4.3 Cancellation & Refunds</h3>
    <ul>
      <li>Each boat owner sets their own cancellation policy.</li>
      <li>Refund eligibility depends on the boat’s specific cancellation terms.</li>
      <li>My Boat Booker is not responsible for disputes regarding cancellations.</li>
    </ul>
    <h3>4.4 Modifications & Extensions</h3>
    <ul>
      <li>Any changes to a confirmed booking must be requested through the platform.</li>
      <li>Owners may accept or decline modification requests.</li>
      <li>Additional costs may apply if a rental is extended or modified.</li>
    </ul>
    <h2>5. Responsibilities & Liability</h2>
    <h3>5.1 Responsibilities of Renters</h3>
    <ul>
      <li>Renters must comply with all applicable boating laws and safety regulations.</li>
      <li>Boats must be returned in the same condition as received.</li>
      <li>Renters are responsible for any damages, fines, or penalties incurred during the rental period.</li>
    </ul>
    <h3>5.2 Responsibilities of Owners</h3>
    <ul>
      <li>Owners must ensure that their boats are safe, well-maintained, and legally compliant.</li>
      <li>Owners must provide accurate and complete information in their listings.</li>
      <li>Any disputes regarding damages, rental conditions, or refunds must be resolved directly between the owner and renter.</li>
    </ul>
    <h3>5.3 Liability Disclaimer</h3>
    <ul>
      <li>My Boat Booker is not responsible for accidents, damages, or disputes between users.</li>
      <li>The platform does not inspect boats or guarantee the accuracy of listings.</li>
      <li>Users agree to hold My Boat Booker harmless from any claims or liabilities resulting from platform use.</li>
    </ul>
    <h2>6. Insurance & Damage Policies</h2>
    <h3>6.1 Insurance Coverage</h3>
    <ul>
      <li>Boat owners must ensure that their boats are adequately insured.</li>
      <li>Renters should confirm with the owner whether insurance coverage is included in the rental.</li>
    </ul>
    <h3>6.2 Security Deposits</h3>
    <ul>
      <li>Owners may require a security deposit to cover potential damages.</li>
      <li>If damage occurs, owners must provide evidence and notify the renter immediately.</li>
      <li>My Boat Booker is not responsible for disputes regarding security deposits.</li>
    </ul>
    <h2>7. Privacy & Data Protection</h2>
    <ul>
      <li>My Boat Booker collects and processes personal data in accordance with our Privacy Policy.</li>
      <li>User information is only shared as necessary to facilitate bookings and ensure platform security.</li>
      <li>Users agree not to misuse or share personal data obtained through the platform.</li>
    </ul>
    <h2>8. Dispute Resolution</h2>
    <h3>8.1 Between Users</h3>
    <ul>
      <li>Owners and renters must attempt to resolve disputes directly.</li>
      <li>If a resolution cannot be reached, My Boat Booker may assist in mediation but is not obligated to intervene.</li>
    </ul>
    <h3>8.2 Governing Law</h3>
    <ul>
      <li>These Terms & Conditions are governed by the laws of the jurisdiction where My Boat Booker is registered.</li>
      <li>Any legal disputes must be resolved in the appropriate courts within that jurisdiction.</li>
    </ul>
    <h2>9. Platform Usage Rights</h2>
    <h3>9.1 Intellectual Property</h3>
    <ul>
      <li>All content on the platform, including logos, images, and text, is the property of My Boat Booker.</li>
      <li>Users may not copy, modify, or distribute platform content without prior consent.</li>
    </ul>
    <h3>9.2 User-Generated Content</h3>
    <ul>
      <li>Users grant My Boat Booker a non-exclusive license to use and display content submitted on the platform (e.g., boat listings, reviews).</li>
    </ul>
    <h2>10. Force Majeure</h2>
    <p>My Boat Booker is not liable for delays, cancellations, or failures in service due to events beyond our control, including but not limited to:</p>
    <ul>
      <li>Natural disasters (hurricanes, storms, earthquakes)</li>
      <li>Government regulations or restrictions</li>
      <li>Strikes or labor disputes</li>
      <li>Technical failures, cyberattacks, or internet outages</li>
    </ul>
    <h2>11. Account Suspension & Termination</h2>
    <p>My Boat Booker reserves the right to suspend or terminate accounts under the following circumstances:</p>
    <ul>
      <li>Violation of these Terms & Conditions.</li>
      <li>Fraudulent or suspicious activity.</li>
      <li>Repeated complaints from other users.</li>
      <li>Non-payment of fees or charges.</li>
    </ul>
    <p>Users whose accounts are terminated may not create new accounts without prior authorization.</p>
    <h2>12. Amendments & Updates</h2>
    <p>My Boat Booker may modify these Terms & Conditions at any time. Users will be notified of significant changes, and continued use of the platform constitutes acceptance of the updated terms.</p>
    <h2>13. Contact Information</h2>
    <p>For questions or concerns about these Terms & Conditions, please contact My Boat Booker Customer Support through our website.</p>
  </div>
</section>

@endsection
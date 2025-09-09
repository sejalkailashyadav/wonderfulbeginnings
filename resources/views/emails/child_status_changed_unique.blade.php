<!Doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ $action }} - Child</title>
</head>
<body style="background:#f0f4f8;font-family:Arial,sans-serif;margin:0;padding:0;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="padding:24px;">
    <tr>
      <td align="center">
        <table role="presentation" width="640" style="background:#fff;border-radius:16px;box-shadow:0 2px 10px rgba(0,0,0,0.05);overflow:hidden;">
          <!-- Header -->
          <tr>
            <td style="background:#2563eb;padding:20px;text-align:center;color:#fff;">
              <h2 style="margin:0;font-size:22px;">Child {{ ucfirst($action) }}</h2>
              <p style="margin:6px 0 0;font-size:12px;opacity:.85;">
    {{ now()->setTimezone('America/Toronto')->format('M d, Y H:i') }}
</p>

            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:24px;">
              <div style="display:flex;gap:20px;align-items:flex-start;">
                <!-- QR Code -->
                <!--<div style="flex:0 0 auto;">-->
                <!--  <img src="{{ $qrCodeUrl }}" alt="QR Code" style="border:1px solid #e5e7eb;border-radius:8px;">-->
                <!--</div>-->
                
                <!-- Child Info -->
                <div style="flex:1;">
                  <p style="margin:0 0 12px;font-size:14px;color:#111;">
                    Below are the details for the updated child record:
                  </p>
                  <ul style="list-style:none;margin:0;padding:0;font-size:14px;">
                    <li><strong>Student ID:</strong> {{ $child->child_id }}</li>
                    <li><strong>Name:</strong> {{ trim(($child->child_first_name ?? '').' '.($child->child_last_name ?? '')) }}</li>
                    <li><strong>DOB:</strong> {{ $child->child_dob ?? '-' }}</li>
                    <li><strong>Center name:</strong> {{ $child->center->center_name ?? '-' }}</li>
                    <li><strong>Class name:</strong> {{ $child->class->class_name ?? '-' }}</li>
                    <li><strong>Fess name:</strong> {{ $child->fee->fees_name ?? '-' }}</li>
                      
                
                    <li>
                      <strong>Status:</strong> 
             
                      
<!--                      <span style="display:inline-block;padding:2px 8px;border-radius:12px;background:-->
<!--  {{ $action === 'approved' ? '#22c55e' : ($action === 'withdrawn' ? '#ef4444' : '#3b82f6') }};-->
<!--  color:#fff;font-size:12px;">-->
<!--  {{ ucfirst($action) }}-->
<!--</span>-->

<span style="display:inline-block;padding:2px 8px;border-radius:12px;
    background:
        {{ $action === 'approved' ? '#22c55e' : 
           ($action === 'withdrawn' ? '#ef4444' : 
           ($action === 'created' ? '#8b5cf6' : '#3b82f6')) }}; 
    color:#fff;font-size:12px;">
    {{ ucfirst($action) }}
</span>


                    </li>
                  </ul>
                  </div>
                </div>
              </div>

              <!-- Button -->
              <p style="margin:20px 0 0;">
                <a href="{{ $detailUrl }}" 
                   style="background:#2563eb;color:#fff;text-decoration:none;padding:10px 16px;border-radius:8px;display:inline-block;">
                  View Full Details
                </a>
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:16px;text-align:center;font-size:12px;color:#6b7280;background:#f9fafb;">
              {{ config('app.name', 'Coco') }} 
            </td>
          </tr> 
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

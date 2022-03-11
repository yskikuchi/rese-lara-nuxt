<p>{{$booking->user->name}}さん</p>
<p>本日、
  @php
    print date('G:i', strtotime($booking->time));
  @endphp
  より、
  「{{$booking->shop->name}}」
  での予約を承っております。</p>
<p>ご来店のほど、お待ちしております。</p>
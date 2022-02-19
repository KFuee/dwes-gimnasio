<div>
  Hola {{ $userName }},

  <p>
    Hemos recibido tu solicitud de reserva. Aquí tienes los datos de la misma:
  </p>

  <ul>
    <li>Actividad: {{ $activityName }}</li>
    <li>Fecha: {{ $date }}</li>
    <li>Hora de inicio: {{ $startTime }}</li>
    <li>Hora de fin: {{ $endTime }}</li>
  </ul>

  <p>
    Saludos,
    Gimnasio.
  </p>
</div>
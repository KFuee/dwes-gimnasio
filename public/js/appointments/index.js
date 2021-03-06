// Una vez se selecciona una actividad, se muestran los meses disponibles
$("#activity_id").change(function () {
    var activity_id = $(this).val();

    $.ajax({
        url: "/appointments/months/" + activity_id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            $("#month").empty();

            $("#month").append('<option value="">Seleccione un mes</option>');

            $.each(data, function (_index, month) {
                $("#month").append(
                    `<option value="${month}">${month}</option>`
                );
            });
        },
    });

    // Deja de ocultar el div de meses
    $("#month").parent().parent().show();
});

// Una vez se selecciona un mes, se muestran las sesiones disponibles
$("#month").change(function () {
    var month = $(this).val();
    var activity_id = $("#activity_id").val();

    $.ajax({
        url: `/appointments/sessions/${activity_id}/${month}`,
        type: "GET",
        dataType: "html",
        success: function (data) {
            $("#available_sessions").html(data);
            $("#available_sessions_count").html(
                $("#available_sessions tr").length - 1
            );
        },
    });

    // Deja de ocultar el div de sesiones
    $("#available_sessions").parent().parent().show();
});

// Controla los cambios en el text input #date-seach
$("#date-search").on("keyup", function () {
    var date = $(this).val();

    // Filtra las sesiones disponibles en función de la fecha
    let counter = 0;
    $("#available_sessions tr").each(function (index) {
        if (index === 0) return;

        var session_date = $(this).find("td:nth-child(2)").text();

        if (session_date.includes(date)) {
            counter++;
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    // Actualiza el contador de sesiones disponibles
    $("#available_sessions_count").html(counter);
});

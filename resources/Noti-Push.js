let userId;
window.OneSignal = window.OneSignal || [];
OneSignal.push(function() {
    OneSignal.init({
        appId: "c33793dd-02e1-402d-adc5-e72dd1fcb039",
        safari_web_id:
            "web.onesignal.auto.5bbdbd5b-a1fd-4f12-ac5b-d6a1270404a1",
        persistNotification: true,
        welcomeNotification: {
            disable: false,
            title: "Bienvenido",
            message: "Te has suscrito a las notificaciones.",
            url: "http://localhost:8000"
        },
        notifyButton: {
            enable: true,
            showCredit: false
        },
        promptOptions: {
            slidedown: {
                prompts: [
                    {
                        ///showCredit:false,
                        type: "push", // current types are "push" & "category"
                        autoPrompt: true,
                        text: {
                            /* limited to 90 characters */
                            actionMessage:
                                "Nos gustaria enviarte notificaciones de las actualizaciones.",
                            /* acceptButton limited to 15 characters */
                            acceptButton: "Permitir",
                            /* cancelButton limited to 15 characters */
                            cancelButton: "Cancelar"
                        },
                        delay: {
                            pageViews: 1,
                            timeDelay: 10
                        }
                    }
                ]
            }
        },
        allowLocalhostAsSecureOrigin: true
    });
    ///OneSignal.setSubscription(false);
    OneSignal.setDefaultNotificationUrl("http://localhost:8000");
    OneSignal.setDefaultTitle("Bienvenido");
    OneSignal.getUserId(function(userId) {
        console.log("OneSignal User ID:", userId);
        if (userId != null) enviarNoti(userId);
    });
});
function enviarNoti(userId) {
    var a = "https://onesignal.com/api/v1/notifications";
    async function sendNotification(url, data) {
        // Opciones por defecto estan marcadas con un *
        const response = await fetch(url, {
            method: "POST",
            mode: "cors",
            cache: "no-cache",
            headers: {
                "Content-Type": "application/json; charset=utf-8"
            },
            body: JSON.stringify(data)
        });
        return response.json();
    }
    var message = {
        app_id: "c33793dd-02e1-402d-adc5-e72dd1fcb039",
        contents: { en: "Mensaje de prueba" },
        include_player_ids: [userId]
    };
    sendNotification(a, message).then(data => {
        console.log(data); // JSON data parsed by `data.json()` call
    });
}

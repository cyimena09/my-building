<div class="page">
    <div class="content-page">
        <h1>Envoyer une communication</h1>
        <form action="/communication/create" method="post">
            <div class="group">
                <label for="subject"></label>
                <input id="subject" name="subject" placeholder="Sujet">
            </div>
            <div class="group">
                <label for="message">Message</label>
                <textarea id="message" name="message" cols="30" rows="10"></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>
<div class="page">
    <div class="content-page">
        <h1>Envoyer un message</h1>
        <form action="/message/create">
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
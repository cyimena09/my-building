<div class="page">
    <div class="content-page">
        <h1>Créer un nouveau ticket</h1>
        <form action="/tickets/create" method="post">
            <div class="group">
                <label for="subject"></label>
                <input id="subject" name="subject" placeholder="Sujet">
            </div>
            <div class="group">
                <label for="description">Description</label>
                <textarea id="description" name="description" cols="30" rows="10"></textarea>
            </div>
            <button type="submit">Créer le ticket</button>
        </form>
    </div>
</div>
<!DOCTYPE html>
<html lang="sk">


<div class="card-body card mx-auto" style="display: block; width: 50rem">
    <section class="container">
        <h4 class="center">Pridaj pracu</h4>
        <form action="" method="POST" class="white">
            <div>
                <div><label>Nazov</label></div>
                <label>
                    <input type="text" name="nazov" style="width: 46rem">
                </label>
                <div class="errorText"></div>
            </div>
            <div>
                <div><label>Veduci</label></div>
                <label>
                    <input type="text" name="veduci" style="width: 46rem">
                </label>
                <div class="errorText"></div>
            </div>
            <div>
                <div><label>Tutor</label></div>
                <label>
                    <input type="text" name="tutor" style="width: 46rem">
                </label>
            </div>
            <div>
                <div><label>Popis</label></div>
                <label>
                    <textarea rows="5" name="popis" style="width: 46rem;row"></textarea>
                </label>
                <div class="errorText"></div>
            </div>

            <label class="text">Katedra</label>
            <div class="input-group">
                <label for="katedra"></label>
                <select class="form-select" id="katedra">
                    <option value="KIS">KIS</option>
                    <option value="KI">KI</option>
                    <option value="KMME">KMME</option>
                    <option value="KMNT">KMNT</option>
                    <option value="KMMOA">KMMOA</option>
                    <option value="KST">KST</option>
                    <option value="KTK">KTK</option>
                </select>
            </div>

            <label class="text">Stupen</label>
            <div class="input-group">
                <label for="stupen"></label>
                <select class="form-select" id="stupen">
                    <option value="Bakalar">Bakalár</option>
                    <option value="Inzinier">Inžinier</option>
                </select>
            </div>

            <label class="text">Odbor</label>
            <div class="input-group">
                <label for="odbor"></label>
                <select class="form-select" id="odbor">
                    <option value="MAN">MAN</option>
                    <option value="INF">INF</option>
                    <option value="IaST">IaST</option>
                    <option value="IaR">IaR</option>
                    <option value="PI">PI</option>
                </select>
            </div>

            <label class="text">Jazyk</label>
            <div class="input-group">
                <label for="jazyk"></label>
                <select class="form-select" id="jazyk">
                    <option selected>...</option>
                    <option value="sk">sk</option>
                    <option value="en">en</option>
                </select>
            </div>



            <div>
                <input type="submit" name="submit" value="Pridaj" style="align-content: center">
            </div>

        </form>
    </section>
</div>


</html>
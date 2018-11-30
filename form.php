<form action="index.php" method="post"> 
    <div class="row">
        <div class="form-group col-md-4">
            <label>Purchase Price</label>

            <div class="input-group">
                <input name="value" class="form-control" type="number" value="<?php echo $mango->getValue(); ?>">
                <span class="input-group-addon">$</span>
            </div>
            <span class="help-block">This is the price of the house you want to buy.</span>
        </div>
        <div class="form-group col-md-4">
            <label>Downpayment</label>

            <div class="input-group">
                <input name="down" class="form-control" type="number" value="<?php echo $mango->getDown(); ?>">
                <span class="input-group-addon">$</span>
            </div>
            <span class="help-block">This is the amount of money you put as a lump sum at the purchase.</span>
        </div>
        <div class="form-group col-md-4">
            <label>Interest Rate</label>

            <div class="input-group">
                <input name="interestRate" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getInterestRate(); ?>">
                <span class="input-group-addon">%</span>
            </div>
            <span class="help-block">Enter the annual interest rate on your mortgage. For 3% enter 3.</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Term</label>

            <div class="input-group">
                <input name="term" class="form-control" type="number" value="<?php echo $mango->getTerm(); ?>"><span
                    class="input-group-addon">years</span>
            </div>
            <span class="help-block">This is the duration of your mortgage in years.</span>
        </div>
        <div class="form-group col-md-4">
            <label>Exit</label>

            <div class="input-group">
                <input name="exit" class="form-control" type="number" value="<?php echo $mango->getExit(); ?>"><span
                    class="input-group-addon">years</span>
            </div>
            <span
                class="help-block">This is the number of years you are planning to hold your house before you sell.</span>
        </div>

        <div class="form-group col-md-4">
            <label>Annual Mortgage Insurance</label>

            <div class="input-group">
                <input name="insurance" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getInsurance(); ?>"><span
                    class="input-group-addon">%</span>
            </div>
            <span class="help-block">If your downpayment doesn't meet the minimum requirements, you are to take on a mortgage insurance.</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>School Tax</label>

            <div class="input-group">
                <input name="school" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getSchool(); ?>"><span
                    class="input-group-addon">%</span>
            </div>
            <span class="help-block">Enter the rate for school tax in your area.</span>
        </div>
        <div class="form-group col-md-4">
            <label>Municipal Tax</label>

            <div class="input-group">
                <input name="municipal" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getMunicipal(); ?>"><span
                    class="input-group-addon">%</span>
            </div>
            <span class="help-block">Enter the rate for municipal tax in your area.</span>

        </div>
        <div class="form-group col-md-4">
            <label>Renovations</label>

            <div class="input-group">
                <input name="renovations" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getRenovations(); ?>"><span
                    class="input-group-addon">%</span>
            </div>
            <span class="help-block">Enter renovations rate to home value. This should be accounted for because a house requires maintenance.</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Condo/HOA Fees</label>

            <div class="input-group">
                <input name="condo" class="form-control" type="number" step="0.001" value="<?php echo $mango->getCondo(); ?>"><span
                    class="input-group-addon">$/month</span>
            </div>
            <span class="help-block">If you plan to purchase a condominium, this is your share of the shared expenses. Enter monthly condo fees</span>

        </div>
        <div class="form-group col-md-4">
            <label>Snow/Lawn</label>

            <div class="input-group">
                <input name="snow" class="form-control" type="number" step="0.001" value="<?php echo $mango->getSnow(); ?>"><span
                    class="input-group-addon">$/year</span>
            </div>
            <span class="help-block">If you are to purchase a house, you will need to pay for snow removal or lawn mowing. Enter annual amount.</span>
        </div>
        <div class="form-group col-md-4">
            <label>Welcome tax</label>

            <div class="input-group">

                <input name="welcome" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getWelcome(); ?>"><span
                    class="input-group-addon">%</span>
            </div>
            <span class="help-block">Some cities welcome new home owner with a nice invoice for ironic welcome tax. It's a one shot payment.</span>

        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Notary fees</label>

            <div class="input-group">
                <input name="notary" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getNotary(); ?>"><span
                    class="input-group-addon">$</span>
            </div>
            <span class="help-block">Enter the notary fees.</span>
        </div>
        <div class="form-group col-md-4">
            <label>Inflation</label>

            <div class="input-group">
                <input name="inflation" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getInflation(); ?>"><span
                    class="input-group-addon">%</span>
            </div>
            <span class="help-block">Enter inflation rate.</span>
        </div>
        <div class="form-group col-md-4">
            <label>Penalty in periods</label>

            <div class="input-group">
                <input name="penalty" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getPenalty(); ?>"><span
                    class="input-group-addon">periods</span>
            </div>
            <span class="help-block">If you intend to sell your house before the term expired. You may be charged penalty for mortgage breaking.</span>

        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Home Value Appreciation Rate</label>

            <div class="input-group">
                <input name="appreciation" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getAppreciation(); ?>"><span
                    class="input-group-addon">%</span>
            </div>
            <span class="help-block">This is the average appreciation rate on your home value.</span>
        </div>

        <div class="form-group col-md-4">
            <label>Rent</label>

            <div class="input-group">
                <input name="rent" class="form-control" type="number"
                       value="<?php echo $mango->getRent(); ?>"><span
                    class="input-group-addon">$/month</span>
            </div>
            <span class="help-block">Enter your monthly rent.</span>

        </div>
        <div class="form-group col-md-4">
            <label>Anniversary</label>

            <div class="input-group">
                <input name="anniversary" class="form-control" type="number" step="0.001"
                       value="<?php echo $mango->getAnniversary(); ?>"><span
                    class="input-group-addon">%</span>
            </div>
            <span class="help-block">Some banks allow home owners to pay percentage of the initial loan as lump sums in each year's anniversary. Enter the percentage of the inital mortgage that you will pay extra every anniversary.</span>

        </div>
    </div>
    <p>By clicking the button below, you agree to <a href="/terms">terms</a></p>

    <div class="row">
        <div class="form-group col-md-4">
            <input type="submit" class="btn btn-success btn-block" value="Should I buy?">
        </div>
    </div>
</form>

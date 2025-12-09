Stripe CLI Run to Local

1. F:\StripeCLI
2. open cmd on this path ( F:\StripeCLI\cmd [enter])
3. Login to stripe and auth via browser ( stripe login )
4. set local webhook url 
    stripe listen --forward-to https://flickcrm_saas.test/saas/stripe_webhook 

5. copy and setup webhook Secret key on php script 
6. now you can see and catch webhook events 


Full Docs 
1) https://docs.stripe.com/stripe-cli/use-cli 
2) https://docs.stripe.com/stripe-cli/install?install-method=windows 



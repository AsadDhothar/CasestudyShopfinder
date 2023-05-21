#  Module Casestudy Shopfinder

    ``casestudy/module-shopfinder``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Shopfinder

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Casestudy`
 - Enable the module by running `php bin/magento module:enable Casestudy_Shopfinder`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require casestudy/module-shopfinder`
 - enable the module by running `php bin/magento module:enable Casestudy_Shopfinder`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


For graphql download app or install ALTAIR chrome extension 

In URL type your URL "http://shop.com/graphql" and under right section use these queries to fetch or update data


## For all data graphql fetch query
    query{
        IdentifierGraphql{
            shop_data{
                shop_name
                identifier
                country
                image
                longitude_latitude
            }
        }
    }

## For single data graphql fetch query using ID
    query{
        IdentifierGraphql(
            identifier: "identifier value"
        ){
            shop_data{
                shop_name
                identifier
                country
                image
                longitude_latitude
            }
        }
    }

## Mutation to update shopper data all columns

    mutation{
        editShopData(
            shopfinder_id: id that needs tobe updated,
            shop_name: "new shop name",
            identifier: "new value",
            country: "new country",
            image: "new value",
            longitude_latitude: "new value"
        ){
            shopfinder_id
            shop_name
            identifier
            country
            image
            longitude_latitude
        }
    }


# Test Cases 
## Positive case for fetch all data
    query{
        IdentifierGraphql{
            shop_data{
                shop_name
                identifier
                country
                image
                longitude_latitude
            }
        }
    }

This will fetch the whole record from table 

## Positive case for fetch data for specific Identifier
    query{
        IdentifierGraphql(
            identifier: "identifier value"
        ){
            shop_data{
                shop_name
                identifier
                country
                image
                longitude_latitude
            }
        }
    }

This will fetch the whole record from table

## Negative case for fetch data for specific Identifier
    query{
        IdentifierGraphql(
            identifier: identifier that doesnot exit
        ){
            shop_data{
                shop_name
                identifier
                country
                image
                longitude_latitude
            }
        }
    }

It will through error as "identifier" is not present in the data




## Positive case for update all columns

    mutation{
        editShopData(
            shopfinder_id: 2,
            shop_name: "new shop name",
            identifier: "new value",
            country: "new country",
            image: "new value",
            longitude_latitude: "new value"
        ){
            shopfinder_id
            shop_name
            identifier
            country
            image
            longitude_latitude
        }
    }

This will find shop with "shopfinder_id" and updates the data that is provided in the query.
## Positive case for update specific columns
    mutation{
        editShopData(
            shopfinder_id: 2,
            shop_name: "new aa name",
            identifier: "new aa",
            country: "new aa"
        ){
            shopfinder_id
            shop_name
            identifier
            country
            image
            longitude_latitude
        }
    }


## Negative case for update data

    mutation{
        editShopData(
            shopfinder_id: id that doesnot exit,
            shop_name: "new shop name",
            identifier: "new value",
            country: "new country",
            image: "new value",
            longitude_latitude: "new value"
        ){
            shopfinder_id
            shop_name
            identifier
            country
            image
            longitude_latitude
        }
    }

It will through error as "shopfinder_id" is not present in the data


















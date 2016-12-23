#Synopsis

This project provides a small CMS for creating menus for your next party. Your party members (customers) can then use your webapp to order the items you provided. The administrators will be informed about the new order via push alert (by pusher.com) if wanted.

#Motivation

The idea of the project lies in 2015/16 when I hosted a lot of partys where I served cocktails as well. The guests arrived and wanted to know which cocktails I would offer. Normally I would tell them "Everything if I've the ingredients" but that was a bad idea as I learned over time. Another problem that occured was keeping track of all the orders. So I decided to write a small app which should provide a party menu for the guests and a order management tool for the host.

#Installation

1. Create a database and run the SQLs provided in the INSTALL folder. I would highly suggest to install with dummy data!
2. Rename the config.php in ressources folder
3. Rename the log.txt file in the logs folder
4. Change the config file (ressources folder) to match your data.
5. Run the application on your website.

Attention: We are in BETA phase right now, so a lot of changes have to be done in the database or in the config file!

#Copyright Notice and License

(c) 2016 Peter Vogelmann

This code is published under the GNU Affero General Public License (v3), a copy is distributed with the source code.
If not, see <http://www.gnu.org/licenses/>.

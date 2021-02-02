#### Easyqueue - service which allows you to create and manage an electronic queue.

Queue owners create and process a client queue.
Clients have the ability to queue up and receive updates on queue changes.

Main features:
 - create your own electronic queue as owner
 - invite participants to the queue
 - monitor and process queue items
 - receive updates about queue changes.
 

#### Authorization in the system
Login or register on the site `1`. After that you can:
  - Create a queue and become its administrator `2`
  - Or get into a queue already created by others by creating a queue item `3`
  
  <div class="btn-group" style="border: 1px solid #dddfeb; border-radius: 5px"> 
  ![Login and act][ab-login]
  </div>
  
  <br>

#### Create queue
When creating a queue. It is necessary to specify the name `1`, determine the visibility of the queue for users` 2` (visible to everyone or by reference).
By default, the queue is active, the elements of the queue are automatically processed and the owner is informed about all events.
 
  <div class="btn-group" style="border: 1px solid #dddfeb; border-radius: 5px"> 
  ![Login and act][ab-queue]
  </div>
  
  <br>
 
#### Queue administration
After the queue is created. You can manage and monitor the status of the queue `5`.
   - You can control the state of queue `1`.
   - Table `2` shows the main parameters and indicators of the queue (Status, average waiting time in the queue, average time to process an item, link to the queue)
   - In the table `3`, you can see items: Active (current) or all (including processed).
   - Here your also can process elements of the queue `4` (change status of an element: in queue; in work; finished; canceled)
  
  <div class="btn-group" style="border: 1px solid #dddfeb; border-radius: 5px"> 
  ![Login and act][ab-handle]
  </div>
  
  <br>
  
#### Get into the queue (create item)
Users can create a queue item - means, get into the queue `1`.
When creating, you need to select a queue (from the list of available ones), or follow the link, then the queue will be selected automatically. `2`
Once created, the queue item can be tracked on the main page and edited.
  
  <div class="btn-group" style="border: 1px solid #dddfeb; border-radius: 5px"> 
  ![Login and act][ab-item]
  </div>
  
The queue owner receives updates about the status of the queue, about the arrival of new items.
Owners of queue items also receive notifications when the status of queue items has changed.
  
[ab-login]: ../../img/faq/ab_login.png
[ab-queue]: ../../img/faq/ab_queue.png
[ab-handle]: ../../img/faq/ab_handle.png
[ab-item]: ../../img/faq/ab_item.png